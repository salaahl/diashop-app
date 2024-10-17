<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ConfirmationEmailJob;
use App\Jobs\NewCommandEmailJob;
use Exception;

class StripePaymentService
{
    public function createSession()
    {
        if (empty(session()->get("basket")))
            throw new Exception("Votre panier est vide");

        $items = [];

        foreach (session()->get("basket") as $basket) {
            foreach ($basket as $item) {

                $items[] = [
                    'price_data' => [
                        'product_data' => [
                            'name' => $item['name'],
                        ],
                        'unit_amount' => $item['price'] * 100,
                        'currency' => 'eur',
                    ],
                    'quantity' => $item['quantity'],
                ];
            };

            $total = $item['price'] * 100;
        };

        $shipping_options = [];

        // Somme à partir de laquelle la livraison est gratuite
        if ($total > env('FREE_SHIPPING', 4999)) {
            $shipping_options[] =
                [
                    'shipping_rate_data' => [
                        'type' => 'fixed_amount',
                        'fixed_amount' => [
                            'amount' => 0,
                            'currency' => 'eur',
                        ],
                        'display_name' => 'Livraison standard GRATUITE',
                        'delivery_estimate' => [
                            'minimum' => [
                                'unit' => 'business_day',
                                'value' => 5,
                            ],
                            'maximum' => [
                                'unit' => 'business_day',
                                'value' => 7,
                            ],
                        ],
                    ]

                ];
        } else {
            $shipping_options[] = [
                'shipping_rate_data' => [
                    'type' => 'fixed_amount',
                    'fixed_amount' => [
                        'amount' => 499,
                        'currency' => 'eur',
                    ],
                    'display_name' => 'Livraison standard',
                    'delivery_estimate' => [
                        'minimum' => [
                            'unit' => 'business_day',
                            'value' => 5,
                        ],
                        'maximum' => [
                            'unit' => 'business_day',
                            'value' => 7,
                        ],
                    ],
                ],
            ];
        }

        $shipping_options[] = [
            'shipping_rate_data' => [
                'type' => 'fixed_amount',
                'fixed_amount' => [
                    'amount' => 1000,
                    'currency' => 'eur',
                ],
                'display_name' => 'Livraison express',
                'delivery_estimate' => [
                    'minimum' => [
                        'unit' => 'business_day',
                        'value' => 2,
                    ],
                    'maximum' => [
                        'unit' => 'business_day',
                        'value' => 4,
                    ],
                ],
            ],
        ];

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $checkout_session = $stripe->checkout->sessions->create([
            'ui_mode' => 'embedded',
            'line_items' => $items,
            'mode' => 'payment',
            'allow_promotion_codes' => true,
            'billing_address_collection' => 'required',
            'shipping_address_collection' => ['allowed_countries' => ['FR']],
            'shipping_options' => $shipping_options,
            'custom_text' => [
                'shipping_address' => [
                    'message' => 'Comptez un délai de deux jours ouvrés pour la livraison express et de cinq jours ouvrés pour la livraison standard.',
                ],
            ],
            'return_url' => env('APP_URL') . '/confirmation/{CHECKOUT_SESSION_ID}',
            'automatic_tax' => [
                'enabled' => true,
            ],
        ]);

        return $checkout_session->client_secret;
    }

    public function registerOrder($stripe_session_id)
    {
        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $session = $stripe->checkout->sessions->retrieve($stripe_session_id);

        // On verifie que le payement est bien terminé
        if ($session->status !== 'complete') {
            throw new Exception("Le payement a échoué");
        }

        // On verifie que la commande n'existe pas
        if (Order::where('stripe_transaction_id', $stripe_session_id)->first() !== null) {
            return Order::where('stripe_transaction_id', $stripe_session_id)->first();
        }

        // Je retire la quantité commandée
        foreach (session()->get("basket") as $items) {
            foreach ($items as $item) {
                $product = Product::where("id", $item['id'])->first();
                $product_quantity = json_decode($product->quantity_per_size, true);
                $product_quantity[$item['size']] -= $item['quantity'];
                $product->quantity_per_size = json_encode($product_quantity);
                $product->save();
            }
        }

        $order = new Order();
        $order->command_number = time();
        $order->fullname = $session->customer_details->name;
        $order->email = $session->customer_details->email;

        $products = [];
        foreach (session()->get("basket") as $items) {
            foreach ($items as $item) {
                $products[$item["id"]] = [
                    $item["size"] => [
                        "name" => $item["name"],
                        "size" => $item["size"],
                        "price" => $item["price"],
                        "quantity" => $item["quantity"]
                    ]
                ];
            }
        }
        $order->products = $products;
        session()->forget("basket");

        $billing_address = [
            "fullname" => $session->customer_details->name,
            "line1" => $session->customer_details->address['line1'],
            "line2" => $session->customer_details->address['line2'],
            "postal_code" => $session->customer_details->address['postal_code'],
            "city" => $session->customer_details->address['city'],
            "country" => $session->customer_details->address['country']
        ];
        $order->billing_address = $billing_address;

        $shipping_address = [
            "fullname" => $session->shipping_details->name,
            "line1" => $session->shipping_details->address['line1'],
            "line2" => $session->shipping_details->address['line2'],
            "postal_code" => $session->shipping_details->address['postal_code'],
            "city" => $session->shipping_details->address['city'],
            "country" => $session->shipping_details->address['country']
        ];
        $order->shipping_address = $shipping_address;

        if ($session->customer_details->phone)
            $order->phone = $session->customer_details->phone;

        if (Auth::user())
            $order->user_id = Auth::user()->id;

        $order->amount = [
            "shipping_cost" => $session->shipping_cost->amount_total,
            "amount_total" => $session->amount_total
        ];

        $order->stripe_transaction_id = $stripe_session_id;
        $order->save();

        // Mail de confirmation à l'acheteur
        dispatch(new ConfirmationEmailJob($order));
        // Notification à l'administrateur
        dispatch(new NewCommandEmailJob($order));

        return $order;
    }

    public function webhooks()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // Replace this endpoint secret with your endpoint's unique secret
        // If you are testing with the CLI, find the secret by running 'stripe listen'
        // If you are using an endpoint defined with the API or dashboard, look in your webhook settings
        // at https://dashboard.stripe.com/webhooks
        $endpoint_secret = env('STRIPE_SECRET_ENDPOINT');

        $payload = @file_get_contents('php://input');
        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            echo '⚠️  Webhook error while parsing basic request.';
            http_response_code(400);
            exit();
        }
        if ($endpoint_secret) {
            // Only verify the event if there is an endpoint secret defined
            // Otherwise use the basic decoded event
            $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
            try {
                $event = \Stripe\Webhook::constructEvent(
                    $payload,
                    $sig_header,
                    $endpoint_secret
                );
            } catch (\Stripe\Exception\SignatureVerificationException $e) {
                // Invalid signature
                echo '⚠️  Webhook error while validating signature.';
                http_response_code(400);
                exit();
            }
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
                // Then define and call a method to handle the successful payment intent.
                // handlePaymentIntentSucceeded($paymentIntent);
                error_log($event->data->object->shipping);
                break;
            case 'payment_method.attached':
                $paymentMethod = $event->data->object; // contains a \Stripe\PaymentMethod
                // Then define and call a method to handle the successful attachment of a PaymentMethod.
                // handlePaymentMethodAttached($paymentMethod);
                error_log($event->data->object);
                break;
            default:
                // Unexpected event type
                error_log($event->data->object);
        }
        http_response_code(200);
    }
}
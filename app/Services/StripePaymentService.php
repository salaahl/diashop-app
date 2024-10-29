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
    public function createSession($delivery_method)
    {
        if (empty(session()->get("basket"))) {
            throw new Exception("Votre panier est vide");
        }

        $items = [];
        $total = 0;

        foreach (session()->get("basket") as $basket) {
            foreach ($basket as $item) {

                $items[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $item['name'],
                        ],
                        'unit_amount' => $item['price'] * 100,
                    ],
                    'quantity' => $item['quantity'],
                ];

                $total += $item['price'] * $item['quantity'] * 100;
            }
        }

        // Options de la session Stripe Checkout
        $checkout_options = [
            'ui_mode' => 'embedded',
            'line_items' => $items,
            'mode' => 'payment',
            'allow_promotion_codes' => true,
            'billing_address_collection' => 'required',
            'return_url' => env('APP_URL') . '/confirmation/{CHECKOUT_SESSION_ID}',
            'automatic_tax' => [
                'enabled' => true,
            ],
        ];

        if ($delivery_method == "mondial-relay") {
            $checkout_options['shipping_address_collection'] = ['allowed_countries' => ['FR']];
            $checkout_options['shipping_options'] = [[
                'shipping_rate_data' => [
                    'type' => 'fixed_amount',
                    'fixed_amount' => [
                        'amount' => $total > env('FREE_SHIPPING', 4999) ? 0 : 499,
                        'currency' => 'eur',
                    ],
                    'display_name' => 'Livraison à domicile',
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
            ]];
            $checkout_options['custom_text'] = [
                'shipping_address' => [
                    'message' => 'Comptez un délai de cinq à sept jours ouvrés pour la livraison à domicile',
                ],
            ];
        }

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $checkout_session = $stripe->checkout->sessions->create($checkout_options);

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
}

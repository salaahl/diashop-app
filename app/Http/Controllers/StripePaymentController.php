<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use App\Repositories\StripePaymentInterfaceRepository;
use App\Repositories\StripePaymentSessionRepository;

class StripePaymentController extends Controller
{
    protected StripePaymentSessionRepository $stripePaymentRepository; // L'instance StripePaymentSessionRepository

    public function __construct(StripePaymentInterfaceRepository $stripePaymentRepository)
    {
        $this->stripePaymentRepository = $stripePaymentRepository;
    }

    public function checkout()
    {
        try {
            $APP_URL = env('APP_URL');

            if (session()->get("basket")) {
                $items = [];
                $total = 0;

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

                    $total += $item['price'] * 100;
                };

                $shipping_options = [];

                if ($total > 4999) {
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
                header('Content-Type: application/json');

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
                    'return_url' => $APP_URL . '/confirmation/{CHECKOUT_SESSION_ID}',
                    'automatic_tax' => [
                        'enabled' => true,
                    ],
                ]);

                return response()->json([
                    'clientSecret' => $checkout_session->client_secret,
                ]);
                http_response_code(200);
            } else {
                return redirect()->route('basket.show');
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
            http_response_code(500);
        }
    }


    public function status()
    {
        try {
            $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
            header('Content-Type: application/json');

            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            $session = $stripe->checkout->sessions->retrieve($jsonObj->session_id);

            if ($session->status == "complete" && session()->get("basket")) {
                // Je génère la facture
                do {
                    $number = rand();
                } while (Order::where("command_number", $number)->first());

                $this->stripePaymentRepository->status($number, $session);
            }

            return response()->json([
                'command_number' => $number,
                'status' => $session->status,
                'customer_details' => $session->customer_details,
                'shipping_details' => $session->shipping_details,
                'amount_total' => $session->amount_total,
                'shipping_cost' => $session->shipping_cost
            ]);
            http_response_code(200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
            http_response_code(500);
        }
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

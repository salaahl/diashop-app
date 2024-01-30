<?php

namespace App\Http\Controllers;

use Exception;

class StripePaymentController extends Controller
{
    public function checkout()
    {
        try {
            $APP_URL = env('APP_URL');

            if (session()->get("basket")) {
                $items = [];

                foreach (session()->get("basket") as $basket) {
                    foreach ($basket as $item) {
                        $items[] = [
                            'price_data' => [
                                'product_data' => [
                                    'name' => $item['name'],
                                    'images' => [$APP_URL . 'images/' . $item['thumbnail']],
                                ],
                                'unit_amount' => $item['price'] * 100,
                                'currency' => 'eur',
                            ],
                            'quantity' => $item['quantity'],
                        ];
                    };
                };

                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                header('Content-Type: application/json');

                $checkout_session = $stripe->checkout->sessions->create([
                    'ui_mode' => 'embedded',
                    'line_items' => $items,
                    'mode' => 'payment',
                    'billing_address_collection' => 'required',
                    'shipping_address_collection' => ['allowed_countries' => ['FR']],
                    'shipping_options' => [
                        [
                            'shipping_rate_data' => [
                                'type' => 'fixed_amount',
                                'fixed_amount' => [
                                    'amount' => 499,
                                    'currency' => 'eur',
                                ],
                                'display_name' => 'Livraison par La Poste',
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
                        ],
                        [
                            'shipping_rate_data' => [
                                'type' => 'fixed_amount',
                                'fixed_amount' => [
                                    'amount' => 1000,
                                    'currency' => 'eur',
                                ],
                                'display_name' => 'Livraison par UPS',
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
                        ],
                    ],
                    'custom_text' => [
                        'shipping_address' => [
                            'message' => 'Comptez un délai de cinq jours ouvrés pour la livraison.',
                        ],
                    ],
                    'return_url' => $APP_URL . 'return/{CHECKOUT_SESSION_ID}',
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

            return response()->json([
                'status' => $session->status,
                'customer_email' => $session->customer_details->email
            ]);
            http_response_code(200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
            http_response_code(500);
        }
    }
}

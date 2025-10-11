<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Exception;

class StripePaymentService
{
    public function createSession()
    {
        if (empty(session()->get("basket")))
            throw new Exception("Votre panier est vide");

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
                        'amount' => env('STANDARD_DELIVERY_CHARGES'),
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

            // Ajout des métadonnées pour le webhook
            'metadata' => [
                'basket' => json_encode(session()->get("basket")),
                'user_id' => Auth::id(), // Sera null si non connecté
            ],
        ]);

        return $checkout_session->client_secret;
    }
}

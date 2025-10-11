<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use App\Services\StripePaymentService;

class StripePaymentController extends Controller
{
    protected StripePaymentService $stripePaymentService;

    public function __construct(StripePaymentService $stripePaymentService)
    {
        $this->stripePaymentService = $stripePaymentService;
    }

    public function checkout()
    {
        try {
            $clientSecret = $this->stripePaymentService->createSession();

            return view('stripe/checkout', [
                'clientSecret' => $clientSecret,
            ]);
        } catch (Exception $e) {
            return redirect()->route('home')->with(
                'error',
                $e->getMessage() ?? 'Une erreur est survenue. Veuillez réessayer.'
            );
        }
    }

    public function confirmation($transactionId)
    {
        $order = Order::where('stripe_transaction_id', $transactionId)->first();

        if (!$order) {
            return redirect()->route('home')->with(
                'error',
                'Erreur lors de la validation de la commande. Veuillez prendre contact avec l\'administrateur du site.'
            );
        }

        session()->forget('basket');

        return view('stripe/confirmation', ['order' => $order]);
    }
}

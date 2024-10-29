<?php

namespace App\Http\Controllers;

use Exception;
use App\Services\StripePaymentService;
use Illuminate\Http\Request;

class StripePaymentController extends Controller
{
    protected StripePaymentService $stripePaymentService; // L'instance StripePaymentService

    public function __construct(StripePaymentService $stripePaymentService)
    {
        $this->stripePaymentService = $stripePaymentService;
    }

    public function checkout(Request $request)
    {
        try {
            $clientSecret = $this->stripePaymentService->createSession($request->delivery_method);

            return response()->json([
                'clientSecret' => $clientSecret,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage() ?? 'Une erreur est survenue. Veuillez réessayer.']);
        }
    }

    public function confirmation($stripe_session_id)
    {
        try {
            $order = $this->stripePaymentService->registerOrder($stripe_session_id);
        } catch (Exception $e) {
            return redirect()->route('home')->with(
                'error',
                $e->getMessage() ??
                    'Erreur lors de la validation de la commande. Veuillez prendre contact avec l\'administrateur du site.'
            );
        }

        return view('stripe/confirmation', [
            "order" => $order
        ]);
    }
}

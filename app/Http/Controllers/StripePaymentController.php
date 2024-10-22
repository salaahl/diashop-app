<?php

namespace App\Http\Controllers;

use Exception;
use App\Services\StripePaymentService;

class StripePaymentController extends Controller
{
    protected StripePaymentService $stripePaymentService; // L'instance StripePaymentService

    public function __construct(StripePaymentService $stripePaymentService)
    {
        $this->stripePaymentService = $stripePaymentService;
    }

    public function checkout()
    {
        try {
            $clientSecret = $this->stripePaymentService->createSession();

            return response()->json([
                'clientSecret' => $clientSecret,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'redirect_url' => route('home'),
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function confirmation($stripe_session_id)
    {
        try {
            $order = $this->stripePaymentService->registerOrder($stripe_session_id);
        } catch (Exception $e) {
            return redirect()->route('home')->with('error', $e->getMessage());
        }

        return view('stripe/confirmation', [
            "order" => $order
        ]);
    }

    public function webhooks()
    {
        //
    }
}

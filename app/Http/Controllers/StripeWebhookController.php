<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use Exception;
use Illuminate\Support\Facades\Log;

use App\Services\StripeWebhookService;

class StripeWebhookController extends Controller
{
    protected StripeWebhookService $stripeWebookService;

    public function __construct(StripeWebhookService $stripeWebhookService)
    {
        $this->stripeWebookService = $stripeWebhookService;
    }

    public function handleWebhook(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (SignatureVerificationException $e) {
            // Signature invalide
            return response()->json(['error' => 'Webhook signature verification failed.'], 403);
        } catch (\UnexpectedValueException $e) {
            // Payload invalide
            return response()->json(['error' => 'Invalid payload.'], 400);
        }

        // Gérer les événements
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                try {
                    $this->stripeWebookService->createOrderFromSession($session);
                } catch (Exception $e) {
                    Log::error($e);
                    return response()->json(['error' => 'Erreur lors de la création de la commande : ' . $e->getMessage()]);
                }
                break;
            default:
                return response()->json(['error' => 'Unhandled event type.'], 400);
                break;
        }

        return response()->json(['status' => 'success']);
    }
}

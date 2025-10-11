<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Jobs\ConfirmationEmailJob;
use App\Jobs\NewCommandEmailJob;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class StripeWebhookController extends Controller
{
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
                $this->createOrderFromSession($session);
                break;
            default:
                return response()->json(['error' => 'Unhandled event type.'], 400);
                break;
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Crée la commande en utilisant les données de la session Stripe
     * @param object $session L'objet Session Stripe
     */
    protected function createOrderFromSession($session)
    {
        $stripe_session_id = $session->id;

        // Vérifier si la commande existe déjà
        if (Order::where('stripe_transaction_id', $stripe_session_id)->exists()) {
            // La commande a déjà été traitée, on arrête
            return;
        }

        $basket = json_decode($session->metadata->basket, true);
        $user_id = $session->metadata->user_id;

        // Mise à jour des stocks
        foreach ($basket as $items) {
            foreach ($items as $item) {
                $product = Product::where("id", $item['id'])->first();
                // Vérification pour s'assurer que le produit existe
                if ($product) {
                    $product_quantity = $product->quantity_per_size;
                    // On s'assure que la taille existe dans le tableau avant de décrémenter
                    if (isset($product_quantity[$item['size']])) {
                        $product_quantity[$item['size']] -= $item['quantity'];
                        $product->quantity_per_size = $product_quantity;
                        $product->save();
                    }
                }
            }
        }

        // Création de la nouvelle commande
        $order = new Order();
        $order->command_number = time();
        $order->fullname = $session->customer_details->name;
        $order->email = $session->customer_details->email;

        $products = [];
        foreach ($basket as $items) {
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

        $billing_address = [
            "fullname" => $session->customer_details->name ?? 'N/A',
            "line1" => $session->customer_details->address['line1'] ?? 'N/A',
            "line2" => $session->customer_details->address['line2'] ?? null,
            "postal_code" => $session->customer_details->address['postal_code'] ?? 'N/A',
            "city" => $session->customer_details->address['city'] ?? 'N/A',
            "country" => $session->customer_details->address['country'] ?? 'N/A'
        ];
        $order->billing_address = $billing_address;

        $shipping_address = [
            "fullname" => $session->shipping_details->name ?? 'N/A',
            "line1" => $session->shipping_details->address['line1'] ?? 'N/A',
            "line2" => $session->shipping_details->address['line2'] ?? null,
            "postal_code" => $session->shipping_details->address['postal_code'] ?? 'N/A',
            "city" => $session->shipping_details->address['city'] ?? 'N/A',
            "country" => $session->shipping_details->address['country'] ?? 'N/A'
        ];
        $order->shipping_address = $shipping_address;

        // Donnée optionnelle
        if ($session->customer_details->phone)
            $order->phone = $session->customer_details->phone;

        // Si l'utilisateur est connecté, ce qui lui permettra de retrouver sa commande dans son dashboard
        if ($user_id)
            $order->user_id = $user_id;

        $order->amount = [
            "shipping_cost" => $session->shipping_cost->amount_total,
            "amount_total" => $session->amount_total
        ];

        $order->stripe_transaction_id = $stripe_session_id;
        $order->save();

        // Envoi des emails
        dispatch(new ConfirmationEmailJob($order));
        dispatch(new NewCommandEmailJob($order));
    }
}

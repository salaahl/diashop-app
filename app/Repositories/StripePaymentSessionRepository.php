<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ConfirmationEmailJob;

class StripePaymentSessionRepository implements StripePaymentInterfaceRepository
{
    public function checkout()
    {
        //
    }

    public function status($number, $session)
    {
        // Je retire la quantité commandée
        foreach (session()->get("basket") as $items) {
            foreach ($items as $item) {
                $product = Product::where("id", $item['id'])->first();
                $product_quantity = $product->quantity_per_size;
                $product_quantity[$item['size']] -= $item['quantity'];
                $product->quantity_per_size = $product_quantity;
                $product->save();
            }
        }

        $order = new Order();
        $order->command_number = $number;
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

        if ($session->customer_details->phone) $order->phone = $session->customer_details->phone;
        if (Auth::user()) $order->user_id = Auth::user()->id;
        $order->amount = [
            "shipping_cost" => $session->shipping_cost->amount_total,
            "amount_total" => $session->amount_total
        ];
        $order->save();

        dispatch(new ConfirmationEmailJob($order));

        session()->forget("basket");
    }

    public function webhooks()
    {
        //
    }
}

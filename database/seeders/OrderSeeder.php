<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $productIds = [
            ['id' => 1, 'quantity' => 2],
            ['id' => 2, 'quantity' => 3],
            ['id' => 3, 'quantity' => 1],
            ['id' => 4, 'quantity' => 3],
            ['id' => 5, 'quantity' => 10],
            ['id' => 6, 'quantity' => 6],
            ['id' => 7, 'quantity' => 1],
        ];

        DB::transaction(function () use ($productIds) {

            $order = Order::create([
                'command_number' => rand(1000, 9999),
                'fullname' => 'John Doe',
                'email' => 'john@example.com',
                'billing_address' => ['line1' => '123 rue A', 'city' => 'Paris'],
                'shipping_address' => ['line1' => '123 rue A', 'city' => 'Paris'],
                'amount' => ['total' => 0],
                'user_id' => 1,
                'total' => 100
            ]);

            $i = [1, 2, 3, 4, 5, 6, 7];

            foreach ($i as $id) {
                DB::table('order_products')->insert([
                    'order_id' => $order->id,
                    'product_id' => 1,
                    'product_name' => 'Nom du produit',
                    'quantity' => 1,
                    'price' => 100,
                ]);

            }
        });
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateOrderProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-order-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migration des produits commandés dans la table order_products';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Migration des produits de commande...');

        $orders = \App\Models\Order::whereNotNull('products')->get();

        foreach ($orders as $order) {
            $products = $order->products;

            if (!is_array($products) || empty($products)) {
                continue;
            }

            foreach ($products as $productId => $sizes) {
                if (!is_array($sizes)) continue;

                foreach ($sizes as $size => $item) {
                    if (!is_array($item)) continue;

                    DB::table('order_products')->insert([
                        'order_id'      => $order->id,
                        'product_id'    => (int) $productId,
                        'product_name'  => $item['name'] ?? '',
                        'quantity'      => $item['quantity'] ?? 1,
                        'price'         => $item['price'] ?? 0,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                }
            }
        }

        $this->info('✅ Migration terminée avec succès.');
    }
}

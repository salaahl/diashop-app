<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Produits pour femme
        Product::factory()->create([
            'name' => 'Foulard rouge', 
            'price' => 9.99,
            'img' => json_encode([
                'products/September2024/qfK98NuJQ5udV92PI8bx',
                'products/November2024/HqAHYdQKKkSLGeHUM6w4',
            ]),
            'catalog_id' => 1,
            'category_id' => 1
        ]);
        Product::factory()->create([
            'name' => 'Foulard jaune', 
            'price' => 9.99, 
            'img' => json_encode([
                'products/September2024/vUkdRLFVbV9oidQmZJ3l',
                'products/November2024/HqAHYdQKKkSLGeHUM6w4',
            ]),
            'catalog_id' => 1,
            'category_id' => 1
        ]);
        Product::factory()->create([
            'name' => 'Foulard vert', 
            'price' => 9.99, 
            'img' => json_encode([
                'products/September2024/1DLX0C0l7anRcvGUnCjI',
                'products/November2024/HqAHYdQKKkSLGeHUM6w4',
            ]),
            'catalog_id' => 1,
            'category_id' => 1
        ]);
        Product::factory()->create([
            'name' => 'Foulard vert', 
            'price' => 9.99, 
            'img' => json_encode([
                'products/September2024/BBl1FPRh4TLLreO0S2XX',
                'products/November2024/HqAHYdQKKkSLGeHUM6w4',
            ]),
            'catalog_id' => 1,
            'category_id' => 1
        ]);
        Product::factory()->create([
            'name' => 'Blazer rouge', 
            'price' => 199,
            'quantity_per_size' => [
                's' => 10,
                'm' => 0,
                'l' => 5,
                'xl' => 7,
                'xxl' => 0,
            ],
            'img' => json_encode([
                'products/September2024/KkVTLnV6m5p9uORKtPZm',
                'products/September2024/15HQJ1CzG28au2WARJfu',
            ]),
            'catalog_id' => 1,
            'category_id' => 2
        ]);
        Product::factory()->create([
            'name' => 'Blazer beige', 
            'price' => 209, 
            'img' => json_encode([
                'products/September2024/bwBOjcP0Bta47qSCRjfs',
                'products/September2024/BqFGZ1eV2ZedP1kMVOM1',
            ]),
            'catalog_id' => 1,
            'category_id' => 2
        ]);
        Product::factory()->create([
            'name' => 'T-shirt beige à slogan', 
            'price' => 119, 
            'img' => json_encode([
                'products/October2024/D3OjJm8Iy7COil92CaH1',
                'products/October2024/rCeJRdulni0WSK4QIw3d.jfif',
            ]),
            'catalog_id' => 1,
            'category_id' => 3
        ]);

        // Produits pour hommes
        Product::factory()->create([
            'name' => 'Blazer gris', 
            'price' => 229, 
            'quantity_per_size' => [
                's' => 0,
                'm' => 2,
                'l' => 8,
                'xl' => 5,
                'xxl' => 1,
            ],
            'img' => json_encode([
                'products/jpeg-optimizer_313C203A6328C800_E01',
                'products/October2024/KwDPj1t0u7PPYOptboFO',
                'products/October2024/b4YZuyqmM5TdvloHz2ZC',
            ]),
            'catalog_id' => 2,
            'category_id' => 4
        ]);
        Product::factory()->create([
            'name' => 'Sac Saddle', 
            'price' => 629, 
            'img' => json_encode([
                'products/October2024/mzWf6jsjirAfjuw8yJ7k.jfif',
                'products/October2024/UDS3PK7pu9U4CtU1Yl8H.jfif',
            ]),
            'catalog_id' => 2,
            'category_id' => 5
        ]);
        Product::factory()->create([
            'name' => 'Chemise à rayures', 
            'price' => 82, 
            'img' => json_encode([
                'products/October2024/7pampgFx81uiNfGmsLxk',
                'products/October2024/JsOyOe7glEbWAfHvWrYj',
            ]),
            'catalog_id' => 2,
            'category_id' => 6
        ]);
    }
}

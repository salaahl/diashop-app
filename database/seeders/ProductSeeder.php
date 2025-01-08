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
        Product::factory()->create([
            'name' => 'Foulard rouge', 
            'price' => 9.99, 'img' => json_encode([
                $this->faker->randomElement('products/September2024/qfK98NuJQ5udV92PI8bx'),
                $this->faker->randomElement('products/November2024/HqAHYdQKKkSLGeHUM6w4'),
            ]),
            'catalog_id' => 1,
            'category_id' => 1
        ]);
        Product::factory()->create([
            'name' => 'Foulard jaune', 
            'price' => 9.99, 'img' => json_encode([
                $this->faker->randomElement('products/September2024/vUkdRLFVbV9oidQmZJ3l'),
                $this->faker->randomElement('products/November2024/HqAHYdQKKkSLGeHUM6w4'),
            ]),
            'catalog_id' => 1,
            'category_id' => 1
        ]);
        Product::factory()->create([
            'name' => 'Foulard vert', 
            'price' => 9.99, 'img' => json_encode([
                $this->faker->randomElement('products/September2024/1DLX0C0l7anRcvGUnCjI'),
                $this->faker->randomElement('products/November2024/HqAHYdQKKkSLGeHUM6w4'),
            ]),
            'catalog_id' => 1,
            'category_id' => 1
        ]);
        Product::factory()->create([
            'name' => 'Foulard vert', 
            'price' => 9.99, 'img' => json_encode([
                $this->faker->randomElement('products/September2024/BBl1FPRh4TLLreO0S2XX'),
                $this->faker->randomElement('products/November2024/HqAHYdQKKkSLGeHUM6w4'),
            ]),
            'catalog_id' => 1,
            'category_id' => 1
        ]);

        // Produits pour hommes
        Product::factory()->create([
            'name' => 'Blazer gris', 
            'price' => 9.99, 'img' => json_encode([
                $this->faker->randomElement('products/October2024/KwDPj1t0u7PPYOptboFO'),
                $this->faker->randomElement('products/October2024/b4YZuyqmM5TdvloHz2ZC'),
            ]),
            'catalog_id' => 2,
            'category_id' => 2
        ]);
    }
}

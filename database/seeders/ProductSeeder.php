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
        Product::factory()->create(['name' => 'Article 1', 'price' => 7.99, 'catalog_id' => 1, 'category_id' => 1]);
        Product::factory()->create(['name' => 'Article 2', 'price' => 10, 'catalog_id' => 1, 'category_id' => 2]);
        Product::factory()->create(['name' => 'Article 3', 'price' => 29.95, 'catalog_id' => 1, 'category_id' => 3]);
        Product::factory()->create(['name' => 'Article 4', 'price' => 19.99, 'catalog_id' => 2, 'category_id' => 4]);
        Product::factory()->create(['name' => 'Article 5', 'price' => 24.99, 'catalog_id' => 2, 'category_id' => 5]);
        Product::factory()->create(['name' => 'Article 6', 'price' => 39.99, 'catalog_id' => 2, 'category_id' => 6]);

        Product::factory()->create(['name' => 'Article 7', 'price' => 9.98, 'catalog_id' => 1, 'category_id' => 1]);
        Product::factory()->create(['name' => 'Article 8', 'price' => 79, 'catalog_id' => 1, 'category_id' => 2]);
        Product::factory()->create(['name' => 'Article 9', 'price' => 29.99, 'catalog_id' => 1, 'category_id' => 3]);
        Product::factory()->create(['name' => 'Article 10', 'price' => 19.99, 'catalog_id' => 2, 'category_id' => 4]);
        Product::factory()->create(['name' => 'Article 11', 'price' => 24.99, 'catalog_id' => 2, 'category_id' => 5]);
        Product::factory()->create(['name' => 'Article 12', 'price' => 39.99, 'catalog_id' => 2, 'category_id' => 6]);

        Product::factory()->create(['name' => 'Article 13', 'price' => 9.99, 'catalog_id' => 1, 'category_id' => 1]);
        Product::factory()->create(['name' => 'Article 14', 'price' => 10, 'catalog_id' => 1, 'category_id' => 2]);
        Product::factory()->create(['name' => 'Article 15', 'price' => 29.95, 'catalog_id' => 1, 'category_id' => 3]);
        Product::factory()->create(['name' => 'Article 16', 'price' => 19.99, 'catalog_id' => 2, 'category_id' => 4]);
        Product::factory()->create(['name' => 'Article 17', 'price' => 24, 'catalog_id' => 2, 'category_id' => 5]);
        Product::factory()->create(['name' => 'Article 18', 'price' => 39.99, 'catalog_id' => 2, 'category_id' => 6]);
    }
}

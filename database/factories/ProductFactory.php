<?php

namespace Database\Factories;

use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker.commerce.productDescription(),
            'price' => $this->faker->randomFloat(2, 10, 200), // Prix entre 10 et 200
            'promotion' => $this->faker->optional()->numberBetween(5, 50), // Entre 5% et 50% de réduction
            'description' => $this->faker->productDescription(),
            'quantity_per_size' => json_encode([
                'S' => $this->faker->numberBetween(0, 100),
                'M' => $this->faker->numberBetween(0, 100),
                'L' => $this->faker->numberBetween(0, 100),
                'XL' => $this->faker->numberBetween(0, 100),
            ]),
            'img' => json_encode([
                $this->faker->imageUrl(640, 480, 'fashion', true, 'Product'),
                $this->faker->imageUrl(640, 480, 'fashion', true, 'Product'),
            ]),
            'catalog_id' => Catalog::factory(),
            'category_id' => Category::factory(),
        ];
    }
}

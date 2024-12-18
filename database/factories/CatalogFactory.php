<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition()
    {
        $names = ['Femme', 'Homme', 'Fille', 'Garçon'];
      
        return [
            'name' => $this->faker->randomElement($names),
            'price' => $this->faker->randomFloat(2, 10, 1000), // Prix entre 10 et 1000
            'promotion' => $this->faker->optional()->numberBetween(0, 50), // Pourcentage de promotion
            'description' => $this->faker->paragraph(),
            'quantity_per_size' => json_encode([
                'S' => $this->faker->numberBetween(0, 100),
                'M' => $this->faker->numberBetween(0, 100),
                'L' => $this->faker->numberBetween(0, 100),
                'XL' => $this->faker->numberBetween(0, 100),
                'XXL' => $this->faker->numberBetween(0, 100),
            ]),
            'img' => json_encode([
                $this->faker->imageUrl(),
                $this->faker->imageUrl(),
            ]),
            'catalog_id' => \App\Models\Catalog::factory(), // Associe un catalogue
            'category_id' => \App\Models\Category::factory(), // Associe une catégorie
        ];
    }
}

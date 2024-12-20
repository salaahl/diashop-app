<?php

namespace Database\Factories;

use App\Models\Catalog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = \App\Models\Category::class;

    public function definition()
    {      
        // Crée un catalogue et récupère son ID
        $catalog = Catalog::factory()->create(); // Crée le catalogue

        return [
            'name' => $this->faker->word(),
            'img' => $this->faker->imageUrl(640, 480, 'fashion', true, 'Product'),
            'catalog_id' => $catalog->id, // Utilisation de l'ID du catalogue
        ];
    }
}

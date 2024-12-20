<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalog>
 */
class CatalogFactory extends Factory
{
    protected $model = \App\Models\Catalog::class;

    public function definition()
    {
        return [
            'name' => 'homme', // Génère un mot unique pour le nom
        ];
    }
}

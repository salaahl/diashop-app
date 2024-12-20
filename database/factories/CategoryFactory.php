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
        $images = [
            'products/November2024/HqAHYdQKKkSLGeHUM6w4',
            'products/November2024/FDi3nUlYbRZIOwP0H90v',
            'products/November2024/xh8kWSboaIsxdj7iWQhV',
            'categories/November2024/Msc6c1mikMxK8qVFInUP',
            'products/October2024/QL62JbF9JrAabwemnTjL',
            'products/October2024/GMId8YUcYpIRpPYlYeW9',
            'products/October2024/OsxasR0ORbJ3RNonvJoR',
            'products/jpeg-optimizer_LOOK_H_24_3_LOOK_128_E01',
            'products/1ADPO093YKKH00N_E01.jfif',
            'products/jpeg-optimizer_313C203A6328C800_E08',
            'products/jpeg-optimizer_313C203A6328C800_E01',
            'products/jpeg-optimizer_443c567a1581c085_1440_1',
            'products/October2024/rCeJRdulni0WSK4QIw3d.jfif',
            'products/October2024/D3OjJm8Iy7COil92CaH1'
        ];

        return [
            'name' => $this->faker->word(),
            'img' => $this->faker->randomElement($images),
            'catalog_id' => Catalog::factory(),
        ];
    }
}

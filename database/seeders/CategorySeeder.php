<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Catalogues pour femmes
        Category::factory()->create([
            'name' => 'foulards',
            'img' => 'categories/September2024/K5bLcIdu3B14COAwk92U',
            'catalog_id' => 1,
        ]);
        Category::factory()->create([
            'name' => 'vestes',
            'img' => 'categories/November2024/Msc6c1mikMxK8qVFInUP',
            'catalog_id' => 1,
        ]);
        Category::factory()->create([
            'name' => 't-shirts',
            'img' => 'categories/October2024/p0yxt5vnSiUi7nuQ0f7H',
            'catalog_id' => 1,
        ]);

        // Catalogues pour hommes
        Category::factory()->create([
            'name' => 'vestes',
            'img' => 'products/jpeg-optimizer_313C203A6328C800_E01',
            'catalog_id' => 2,
        ]);
        Category::factory()->create([
            'name' => 'sacs',
            'img' => 'products/1ADPO093YKKH00N_E01.jfif',
            'catalog_id' => 2,
        ]);
        Category::factory()->create([
            'name' => 'chemises',
            'img' => 'products/October2024/QL62JbF9JrAabwemnTjL',
            'catalog_id' => 2,
        ]);
    }
}

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
            'img' => 'products/November2024/gVX09v8iXPJsabL84vfo',
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
            'img' => 'categories/November2024/a0ebPzP86ivwpHTd3svS',
            'catalog_id' => 2,
        ]);
        Category::factory()->create([
            'name' => 'chemises',
            'img' => 'products/October2024/QL62JbF9JrAabwemnTjL',
            'catalog_id' => 2,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->create([
            'name' => 'foulards',
            'catalog_id' => 1,
        ]);

        // Catalogues pour hommes
        Category::factory()->create([
            'name' => 'vestes',
            'catalog_id' => 2,
        ]);
    }
}

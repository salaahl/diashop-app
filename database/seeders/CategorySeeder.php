<?php

namespace Database\Seeders;

use App\Models\Category;
use COM;
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
            'name' => 't-shirt',
            'catalog_id' => 1,
        ]);
        Category::factory()->create([
            'name' => 'pantalon',
            'catalog_id' => 1,
        ]);
        Category::factory()->create([
            'name' => 'chaussure',
            'catalog_id' => 1,
        ]);
        Category::factory()->create([
            'name' => 'chemise',
            'catalog_id' => 2,
        ]);
        Category::factory()->create([
            'name' => 'pantalon',
            'catalog_id' => 2,
        ]);
        Category::factory()->create([
            'name' => 'chaussure',
            'catalog_id' => 2,
        ]);
    }
}

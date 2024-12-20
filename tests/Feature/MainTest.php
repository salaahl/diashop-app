<?php

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Product;

beforeEach(function () {
    global $catalog, $category, $productA;

    // Créations d'articles au préalable
    $catalog = Catalog::factory()->create();
    $category = Category::factory()->create([
        'catalog_id' => $catalog->id
    ]);
    $productA = Product::factory()->create([
        'name' => 'Article 1',
        'price' => 9.99,
        'catalog_id' => $catalog->id,
        'category_id' => $category->id,
    ]);
    $productB = Product::factory()->create([
        'name' => 'Article 2',
        'price' => 10,
        'catalog_id' => $catalog->id,
        'category_id' => $category->id,
    ]);
    $productC = Product::factory()->create([
        'name' => 'Article 3',
        'price' => 29.95,
        'catalog_id' => $catalog->id,
        'category_id' => $category->id,
    ]);
});

afterEach(function () {
    // Suppression des données crées au préalable
    Catalog::query()->delete();
    Category::query()->delete();
    Product::query()->delete();
});

test('ouverture de la page d\'accueil', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});

test('retourne une liste d\'articles triés selon le filtre par defaut (nouveautés)', function () {
    global $catalog;

    $response = $this->get('/catalog/' . $catalog->name);
    $response->assertStatus(200);
});

test('ouverture de la page de présentation d\'un article', function () {
    global $catalog, $category, $productA;

    $response = $this->get('/catalog/' . $catalog->name . '/' . $category->name . '/' . $productA->id);
    $response->assertStatus(200);
});

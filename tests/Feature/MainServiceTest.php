<?php

use App\Services\ProductService;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Product;

beforeEach(function () {
    // Créations d'articles au préalable
    $this->catalog = Catalog::factory()->create();
    $this->category = Category::factory()->create([
        'catalog_id' => $this->catalog->id
    ]);
    $productA = Product::factory()->create([
        'name' => 'Article 1',
        'price' => 9.99,
        'category_id' => $this->category->id,
    ]);
    $productB = Product::factory()->create([
        'name' => 'Article 2',
        'price' => 10,
        'category_id' => $this->category->id,
    ]);
    $productC = Product::factory()->create([
        'name' => 'Article 3',
        'price' => 29.95,
        'category_id' => $this->category->id,
    ]);
});

afterEach(function () {
    // Suppression des données crées au préalable
    Catalog::query()->delete();
    Category::query()->delete();
    Product::query()->delete();
});

test('retourne une liste d\'articles triés selon le filtre "price-lowest"', function () {
    $products = app(ProductService::class)->getProductsByFilter($this->catalog->id, 'price-lowest');

    // Vérifie que le premier article est bien le moins cher de tous
    expect($products->pluck('name')->toArray())->toBe(['Article 1', 'Article 2', 'Article 3']);
});

test('retourne une liste d\'articles sélectionnés selon une catégorie et triés selon le filtre "price-highest"', function () {
    $products = app(ProductService::class)->getProductsByCategoryAndFilter($this->catalog->id, $this->category->name, 'price-highest');

    expect($products->pluck('name')->toArray())->toBe(['Article 3', 'Article 2', 'Article 1']);
});

test('retourne une liste d\'articles dont le nom correspond au moins pour partie à la saisie', function () {
    $response = app(ProductService::class)->searchProductsAsync('Homme', '2');

    // Si $response est un tableau, convertissez-le en Collection
    $response = collect($response);

    expect($response->contains(fn($product) => $product['name'] === 'Article 2'))->toBe(true);
});

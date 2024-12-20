<?php

use App\Services\MainService;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Product;

test('retourne une liste d\'articles triés selon le filtre "price-lowest"', function () {
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

    $response = $this->get('/catalog/' . $catalog->name . '?filter=price-highest');
    $response->assertOk();

    $products = app(MainService::class)->getProductsByFilter($catalog->id, 'price-lowest');

    // Le "assertJsonFragment" permet de s'assurer que le produit renseigné fait bien parti de la réponse
    $products->assertJsonFragment(['name' => 'Article 2']);
    $products->assertJsonFragment(['name' => 'Article 1']);
    $products->assertJsonFragment(['name' => 'Article 3']);

    // Vérifie que le premier article est bien le moins cher de tous
    expect($products->data->first()->name)->toBe('Article 1');
});

test('retourne une liste d\'articles sélectionnés selon une catégorie et triés selon le filtre "price-highest"', function () {
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

    $response = $this->get('/catalog/' . $catalog->name . '/' . $category->name . '?filter=price-highest');
    $response->assertOk();

    $products = app(MainService::class)->getProductsByFilter($catalog->id, $category->name, 'price-highest');

    // Le "assertJsonFragment" permet de s'assurer que le produit renseigné fait bien parti de la réponse
    $products->assertJsonFragment(['name' => 'Article 2']);
    $products->assertJsonFragment(['name' => 'Article 1']);
    $products->assertJsonFragment(['name' => 'Article 3']);

    // Vérifie que le premier article est bien le moins cher de tous
    expect($products->data->first()->name)->toBe('Article 3');
});

test('retourne une liste d\'articles dont le nom correspond au moins pour partie à la saisie', function () {
    $response = app(MainService::class)->searchProductsAsync('Homme', 'roduct');

    expect($response->assertJsonFragment(['name' => 'Product E']))->toBe(true);
});

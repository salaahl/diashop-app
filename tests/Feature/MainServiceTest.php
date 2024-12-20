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
    $products = Product::factory()->count(5)->create([
            'catalog_id' => $catalog->id,
            'category_id' => $category->id,
    ]);

    $response = $this->get('/catalog/femme');
    $response->assertOk();

    $products = app(MainService::class)->getProductsByFilter(2, 'price-lowest');

    // Le "assertJsonFragment" permet de s'assurer que le produit renseigné fait bien parti de la réponse
    $products->assertJsonFragment(['name' => 'Product C', 'price' => 29.99, catalog => 'Femme']);
    $products->assertJsonFragment(['name' => 'Product A', 'price' => 9.99, catalog => 'Femme']);
    $products->assertJsonFragment(['name' => 'Product B', 'price' => 19.99, catalog => 'Femme']);

    // Vérifie que les produits sont triés par price ASC
    expect($products->data->first()->name)->toBe('Product A');
});

test('retourne une liste d\'articles sélectionnés selon la catégorie "t-shirts" et triés selon le filtre "price-highest"', function () {
    $response = app(MainService::class)->getProductsByFilter(2, 't-shirts', 'price-highest');

    $response->assertStatus(200);
    $response->assertJsonFragment(['name' => 'Product D', 'price' => 39.99, catalog => 'Homme']);
    $response->assertJsonFragment(['name' => 'Product F', 'price' => 59.99, catalog => 'Homme']);
    $response->assertJsonFragment(['name' => 'Product E', 'price' => 49.99, catalog => 'Homme']);

    expect($response->data->first()->name)->toBe('Product F');
});

test('retourne une liste d\'articles dont le nom correspond au moins pour partie à la saisie', function () {
    $response = app(MainService::class)->searchProductsAsync('Homme', 'roduct');

    expect($response->assertJsonFragment(['name' => 'Product E']))->toBe(true);
});

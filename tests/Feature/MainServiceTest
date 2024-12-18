<?php

use App\Services\MainService;

test('retourne une liste d'articles triés selon le filtre "price-lowest"', function () {
    $response = app(MainService::class)->getProductsByFilter(2, 'price-lowest');

    $response->assertStatus(200);

    // Le "assertJsonFragment" permet de s'assurer que le produit renseigné fait bien parti de la réponse
    $response->assertJsonFragment(['name' => 'Product C', 'price' => 29.99, catalog => 'Femme']);
    $response->assertJsonFragment(['name' => 'Product A', 'price' => 9.99, catalog => 'Femme']);
    $response->assertJsonFragment(['name' => 'Product B', 'price' => 19.99, catalog => 'Femme']);

    // Vérifie que les produits sont triés par price ASC
    expect($response->data->first()->name)->toBe('Product A');
});

test('retourne une liste d'articles sélectionnés selon la catégorie "t-shirts" et triés selon le filtre "price-highest"', function () {
    $response = app(MainService::class)->getProductsByFilter(2, 't-shirts', 'price-highest');

    $response->assertStatus(200);
    $response->assertJsonFragment(['name' => 'Product D', 'price' => 39.99, catalog => 'Homme']);
    $response->assertJsonFragment(['name' => 'Product F', 'price' => 59.99, catalog => 'Homme']);
    $response->assertJsonFragment(['name' => 'Product E', 'price' => 49.99, catalog => 'Homme']);

    expect($response->data->first()->name)->toBe('Product F');
});

test('retourne une liste d'articles dont le nom correspond au moins pour partie à la saisie', function () {
    $response = app(MainService::class)->searchProductsAsync('Homme', 'roduct');

    expect($response->assertJsonFragment(['name' => 'Product E']))->toBe(true);
});

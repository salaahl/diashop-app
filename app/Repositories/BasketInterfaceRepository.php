<?php

namespace App\Repositories;

interface BasketInterfaceRepository
{
    // Afficher le panier
    public function show();

    // Ajouter un produit au panier
    public function store($product_id, $size, $quantity);

    // Mettre à jour la quantité d'un produit au panier
    public function update($product_id, $size, $quantity);

    // Retirer un produit du panier
    public function remove($product_id, $size);

    // Vider le panier
    public function destroy();
}

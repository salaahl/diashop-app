<?php

namespace App\Repositories;

interface BasketInterfaceRepository
{
    // Afficher le panier
    public function show();

    // Ajouter un produit au panier
    public function store($size, $quantity, $option_id);

    // Mettre à jour la quantité d'un produit au panier
    public function update($option_id, $quantity);

    // Retirer un produit du panier
    public function remove($option_id);

    // Vider le panier
    public function destroy();
}

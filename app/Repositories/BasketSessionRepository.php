<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Option;

class BasketSessionRepository implements BasketInterfaceRepository
{

    # Afficher le panier
    public function show()
    {
        return view("basket"); // resources\views\basket\show.blade.php
    }

    # Ajouter/Mettre à jour un produit du panier
    public function store($size, $quantity, $option_id)
    {
        $basket = session()->get("basket");
        $product = Product::where(
            "id",
            Option::where('id', $option_id)->first()->product_id
        )->first();
        $option = Option::where('id', $option_id)->first();

        // Les informations du produit à ajouter
        $product_details = [
            'thumbnail' => $option->img_thumbnail[0],
            'name' => $product->name,
            'price' => $product->price,
            'size' => $size,
            'quantity' => $quantity,
            'option_id' => $option->id
        ];

        $basket[$option->id][$size] = $product_details; // On ajoute ou on met à jour le produit au panier
        session()->put("basket", $basket); // On enregistre le panier
    }

    # Mettre à jour un produit du panier
    public function update($option_id, $quantity)
    {
        $basket = session()->get("basket");
        $option = Option::where('id', $option_id)->first();

        $basket[$option->id - 1]['quantity'] = $quantity; // On ajoute ou on met à jour le produit au panier
        session()->put("basket", $basket); // On enregistre le panier
    }

    # Retirer un produit du panier
    public function remove($option_id)
    {
        $basket = session()->get("basket"); // On récupère le panier en session
        unset($basket[$option_id]); // On supprime le produit du tableau $basket
        session()->put("basket", $basket); // On enregistre le panier
    }

    # Vider le panier
    public function destroy()
    {
        session()->forget("basket"); // On supprime le panier en session
    }
}

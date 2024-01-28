<?php

namespace App\Repositories;

use App\Models\Product;

class BasketSessionRepository implements BasketInterfaceRepository
{

    # Afficher le panier
    public function show()
    {
        return view("basket"); // resources\views\basket\show.blade.php
    }

    # Ajouter/Mettre à jour un produit du panier
    public function store($size, $quantity, $product_id)
    {
        $basket = session()->get("basket");
        $product = Product::where("id", $product_id)->get();

        // Les informations du produit à ajouter
        $product_details = [
            'thumbnail' => $product->img_thumbnail[0],
            'name' => $product->name,
            'price' => $product->price,
            'size' => $size,
            'quantity' => $quantity,
            'product_id' => $product_id
        ];

        $basket[$product_id][$size] = $product_details; // On ajoute ou on met à jour le produit au panier
        session()->put("basket", $basket); // On enregistre le panier
    }

    # Mettre à jour un produit du panier
    public function update($product_id, $quantity)
    {
        $basket = session()->get("basket");
        $product = Product::where('id', $product_id)->get();

        $basket[$product_id - 1]['quantity'] = $quantity; // On ajoute ou on met à jour le produit au panier
        session()->put("basket", $basket); // On enregistre le panier
    }

    # Retirer un produit du panier
    public function remove($product_id)
    {
        $basket = session()->get("basket"); // On récupère le panier en session
        unset($basket[$product_id]); // On supprime le produit du tableau $basket
        session()->put("basket", $basket); // On enregistre le panier
    }

    # Vider le panier
    public function destroy()
    {
        session()->forget("basket"); // On supprime le panier en session
    }
}

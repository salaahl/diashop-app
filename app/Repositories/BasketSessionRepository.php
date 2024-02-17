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
    public function store($product_id, $size, $quantity)
    {
        $basket = session()->get("basket");
        $product = Product::where("id", $product_id)->first();

        // Les informations du produit à ajouter
        $product_details = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'size' => $size,
            'quantity' => $quantity,
            'img' => $product->img[0],
            'catalog' => $product->catalog->name,
            'category' => $product->category->name
        ];

        $basket[$product_id][$size] = $product_details; // On ajoute ou on met à jour le produit au panier
        session()->put("basket", $basket); // On enregistre le panier
    }

    # Mettre à jour un produit du panier
    public function update($product_id, $size, $quantity)
    {
        $basket = session()->get("basket");
        $product = Product::where("id", $product_id)->first();

        if ($product->quantity_per_size[$size] >= $quantity) {
            $basket[$product_id][$size]['quantity'] = $quantity; // On ajoute ou on met à jour le produit au panier
            session()->put("basket", $basket); // On enregistre le panier
        }
    }

    # Retirer un produit du panier
    public function remove($product_id, $size)
    {
        $basket = session()->get("basket"); // On récupère le panier en session
        unset($basket[$product_id][$size]); // On supprime le produit du tableau $basket
        if (empty($basket[$product_id])) unset($basket[$product_id]); // On supprime également la clé du produit si elle ne contient plus rien
        session()->put("basket", $basket); // On enregistre le panier
        // Si le panier est - désormais - vide alors supprimer
        if (empty(session()->get("basket"))) {
            $this->destroy();
        }
    }

    # Vider le panier
    public function destroy()
    {
        session()->forget("basket"); // On supprime le panier en session
    }
}

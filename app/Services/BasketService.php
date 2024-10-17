<?php

namespace App\Services;

use Exception;
use App\Models\Product;

class BasketService
{
    # Ajouter/Mettre à jour un produit du panier
    public function store($product_id, $size, $quantity)
    {
        $basket = session()->get("basket");
        $product = Product::where("id", $product_id)->first();

        // Je verifie que le stock est suffisant
        if (json_decode($product->quantity_per_size, true)[$size] < $quantity) {
            throw new Exception("Stock insuffisant.");
        }

        $product_image = json_decode($product->img, true)[0];
        $product->promotion ?
            $price = round($product->price - ($product->price / 100 * $product->promotion), 2)
            : $price = $product->price;

        // Les informations du produit à ajouter
        $product_details = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $price,
            'size' => $size,
            'quantity' => $quantity,
            'img' => $product_image,
            'catalog' => $product->catalog->name,
            'category' => $product->category->name
        ];

        $basket[$product_id][$size] = $product_details; // On ajoute ou on met à jour le produit au panier
        session()->put("basket", $basket); // On enregistre le panier
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
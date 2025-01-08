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

        if ($basket) {
            // Je vérifie que le panier ne depasse pas les 30 produits
            $total = 0;

            foreach ($basket as $key => $items_per_size) {
                $total += count($items_per_size);
            }

            if ($total > 30) {
                throw new Exception("Impossible de commander plus de 30 produits.");
            }
        }

        // Je verifie que le stock est suffisant
        if ($product->quantity_per_size[$size] < $quantity) {
            throw new Exception("Stock insuffisant. Veuillez actualiser la page.");
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

        // Je retire la quantité au produit dans la BDD
        $quantity_per_size = $product->quantity_per_size;
        $quantity_per_size[$size] -= $quantity;
        $product->quantity_per_size = json_encode($quantity_per_size);
        $product->save();

        $basket[$product_id][$size] = $product_details; // On ajoute ou on met à jour le produit au panier
        session()->put("basket", $basket); // On enregistre le panier
    }

    # Retirer un produit du panier
    public function remove($product_id, $size, $quantity)
    {
        $basket = session()->get("basket");

        unset($basket[$product_id][$size]); // On supprime le produit du tableau $basket
        if (empty($basket[$product_id])) unset($basket[$product_id]); // On supprime également la clé du produit si elle ne contient plus rien
        session()->put("basket", $basket); // On enregistre le panier

        // Si le panier est - désormais - vide alors supprimer
        if (empty(session()->get("basket"))) {
            $this->destroy();
        }

        // Je reattribue les quantités aux produits
        $product = Product::where('id', $product_id)->first();
        $quantity_per_size = $product->quantity_per_size;
        $quantity_per_size[$size] += $quantity;
        $product->quantity_per_size = json_encode($quantity_per_size);
        $product->save();
    }

    # Vider le panier
    public function destroy()
    {
        // Compléter avec un foreach qui recréditera les quantités dans la BDD
        $basket = session()->get("basket");

        // Je réattribue les quantités aux produits
        foreach ($basket as $items) {
            foreach ($items as $item) {
                $product = Product::where('id', $item['id'])->first();
                $quantity_per_size = $product->quantity_per_size;
                $quantity_per_size[$item['size']] += $item['quantity'];
                $product->quantity_per_size = json_encode($quantity_per_size);
                $product->save();
            }
        }

        session()->forget("basket"); // On supprime le panier en session
    }
}

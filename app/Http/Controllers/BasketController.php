<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\BasketService;

class BasketController extends Controller
{
    protected BasketService $basketService; // L'instance BasketService

    public function __construct(BasketService $basketService)
    {
        $this->basketService = $basketService;
    }

    # Ajout d'un produit au panier
    public function store(Request $request)
    {
        // Validation du panier
        $request->validate([
            "size" => ["required", "string", "min:1", "max: 3"],
            "quantity" => ["required", "numeric", "min:1", "max: 9"],
            "product_id" => ["required", "numeric"],
        ]);

        // On ajoute le produit au panier
        try {
            // Ajout/Mise à jour du produit au panier avec sa quantité
            $this->basketService->store($request->product_id, $request->size, $request->quantity);

            return response()->json([
                'basket' => session()->get("basket"),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    // Suppression d'un produit du panier
    public function remove(Request $request)
    {
        try {
            // Suppression du produit du panier par son identifiant
            $this->basketService->remove($request->product_id, $request->size, $request->quantity);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    // Vider la panier
    public function destroy()
    {
        try {
            // Suppression des informations du panier en session
            $this->basketService->destroy();
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}

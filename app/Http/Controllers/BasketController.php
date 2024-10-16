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
            "size" => ["required"],
            "quantity" => ["required", "numeric", "min:1"],
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
            $this->basketService->remove($request->product_id, $request->size);
        } catch (Exception $e) {
            return response()->json([
                'http_response_code' => http_response_code(500),
                'error' => $e->getMessage(),
            ]);
        }

        return http_response_code(200);
    }

    // Vider la panier
    public function destroy()
    {
        // Suppression des informations du panier en session
        $this->basketService->destroy();

        // Redirection vers le panier
        return back()->withMessage("Panier vidé");
    }
}

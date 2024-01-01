<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\BasketInterfaceRepository;
use App\Repositories\BasketSessionRepository;

class BasketController extends Controller
{

    protected BasketSessionRepository $basketRepository; // L'instance BasketSessionRepository

    public function __construct(BasketInterfaceRepository $basketRepository)
    {
        $this->basketRepository = $basketRepository;
    }

    # Affichage du panier
    public function show()
    {
        return view("basket"); // resources\views\basket\show.blade.php
    }

    # Ajout d'un produit au panier
    public function store(Request $request)
    {
        try {
            $request->validate([
                "size" => ["required"],
                "quantity" => ["required", "numeric", "min:1"],
                "option_id" => ["required", "numeric"],
            ]);

            // Ajout/Mise à jour du produit au panier avec sa quantité
            $this->basketRepository->store($request->size, $request->quantity, $request->option_id);
        } catch (Exception $e) {
            return response()->json([
                'http_response_code' => http_response_code(500),
                'error' => $e->getMessage(),
            ]);
        }

        return http_response_code(200);
    }

    // Mise à jour d'un produit du panier
    public function update(Request $request)
    {
        try {
            // Suppression du produit du panier par son identifiant
            $this->basketRepository->update($request->option_id, $request->quantity);
        } catch (Exception $e) {
            return response()->json([
                'http_response_code' => http_response_code(500),
                'error' => $e->getMessage(),
            ]);
        }

        return http_response_code(200);
    }

    // Suppression d'un produit du panier
    public function remove(Request $request)
    {
        try {
            // Suppression du produit du panier par son identifiant
            $this->basketRepository->remove($request->option_id);

            // Si c'est la dernier produit et que le panier est par conséquent vide
            if (session('basket')) {
                $this->basketRepository->destroy();
            }
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
        $this->basketRepository->destroy();

        // Redirection vers le panier
        return back()->withMessage("Panier vidé");
    }
}

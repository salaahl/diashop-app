<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "product_id" => ['required', 'integer'],
        ]);

        try {
            $user = Auth::user();
            $favorite = new Favorite();

            $favorite->user_id = $user->id;
            $favorite->product_id = $request->product_id;
            $favorite->save();

            return response()->json([
                'status' => http_response_code(200),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        $products_id = [];
        $favorites = Auth::user()->favorites;

        foreach ($favorites as $favorite) {
            $products_id[] = $favorite->product_id;
        }

        $products = null;

        if (Product::whereIn("id", $products_id)->orderBy('created_at', 'ASC')->first()) {
            $products = Product::whereIn("id", $products_id)->orderBy('created_at', 'ASC')->paginate(12);
        }

        return view('favorites', [
            "products" => $products,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $user = Auth::user();
            $favorite = Favorite::where([
                ["user_id", $user->id],
                ["product_id", $request->product_id]
            ])->first();

            $favorite->delete();

            return response()->json([
                'status' => http_response_code(200),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}

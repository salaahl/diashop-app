<?php

namespace App\Http\Controllers;

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

        $user = Auth::user();

        foreach ($user->favorites as $user_favorite) {
            if ($user_favorite->product_id == $request->product_id) {
                $user_favorite->delete();
            } else {
                $favorite = new Favorite();
                $favorite->user_id = $user->id;
                $favorite->product_id = $request->product_id;

                $favorite->save();
            }
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

        $products = Product::whereIn("id", $products_id)->orderBy('created_at', 'ASC')->paginate(12);

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
    public function destroy(Favorite $favorite)
    {
        //
    }
}

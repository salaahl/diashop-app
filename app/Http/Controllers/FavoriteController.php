<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Option;
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
            "option_id" => ['required', 'integer'],
        ]);

        $user = Auth::user();

        $favorite = new Favorite();

        $favorite->user_id = $user->id;
        $favorite->option_id = $request->option_id;

        $favorite->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        $user = Auth::user();

        $favorites = User::where("email", $user->email)->first()->favorites;

        $products = Option::whereIn("id", $favorites->id)->get();

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

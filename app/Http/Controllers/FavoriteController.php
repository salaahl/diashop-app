<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\Product;
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
        $options_id = [];
        $favorites = Auth::user()->favorites;

        foreach ($favorites as $favorite) {
            $options_id[] = $favorite->id;
        }

        $options = Option::whereIn("id", $options_id)->orderBy('created_at', 'ASC')->paginate(12);

        return view('favorites', [
            "options" => $options,
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

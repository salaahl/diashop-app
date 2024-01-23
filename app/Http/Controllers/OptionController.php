<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Option;
use Illuminate\Support\Facades\Redirect;

class OptionController extends Controller
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
        $products = Product::all();

        return view('manage/add-option', [
            "products" => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "product_id" => ['required', 'integer'],
            "color" => ['required', 'string', 'min:2', 'max:60'],
            "thumbnail_one" => ['required', 'file', 'mimes:jpg,jpeg,png'],
            "thumbnail_two" => ['required', 'file', 'mimes:jpg,jpeg,png'],
            "picture_one" => ['required', 'file', 'mimes:jpg,jpeg,png'],
            "picture_two" => ['nullable', 'file', 'mimes:jpg,jpeg,png'],
            "picture_three" => ['nullable', 'file', 'mimes:jpg,jpeg,png'],
            "picture_four" => ['nullable', 'file', 'mimes:jpg,jpeg,png'],
        ]);

        if (!Option::where([
            ["color", $request->color],
            ["product_id", $request->product_id]
        ])->first()) {
            $images = [$request->picture_one->getClientOriginalName()];
            if($request->picture_two) $images[] = $request->picture_two->getClientOriginalName();
            if($request->picture_three) $images[] = $request->picture_three->getClientOriginalName();
            if($request->picture_four) $images[] = $request->picture_four->getClientOriginalName();

            $option = new Option();
            $option->color = strtolower($request->color);
            $option->img_thumbnail = [$request->thumbnail_one->getClientOriginalName(), $request->thumbnail_two->getClientOriginalName()];
            $option->img_fullsize = $images;
            $option->product_id = $request->product_id;
            $option->save();
        } else {
            return Redirect::back()->withErrors(['msg' => 'Erreur. Cette variante de l\'article existe déjà.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        //
    }
}

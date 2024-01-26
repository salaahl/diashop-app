<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Exception;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
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
        $catalogs = Catalog::all();

        return view('manage/add-product', [
            "catalogs" => $catalogs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ['required', 'string', 'min:2', 'max:60'],
            "catalog_id" => ['required', 'integer'],
            "category_id" => ['required', 'integer'],
            "price" => ['required', 'numeric'],
            "description" => ['required', 'string', 'min:2', 'max:400'],
            "color" => ['required', 'string', 'min:2', 'max:60'],
            "thumbnail_one" => ['required', 'file', 'mimes:jpg,jpeg,png'],
            "thumbnail_two" => ['required', 'file', 'mimes:jpg,jpeg,png'],
            "picture_one" => ['required', 'file', 'mimes:jpg,jpeg,png'],
            "picture_two" => ['nullable', 'file', 'mimes:jpg,jpeg,png'],
            "picture_three" => ['nullable', 'file', 'mimes:jpg,jpeg,png'],
            "picture_four" => ['nullable', 'file', 'mimes:jpg,jpeg,png'],
            "quantity_s" => ['nullable', 'integer'],
            "quantity_m" => ['nullable', 'integer'],
            "quantity_l" => ['nullable', 'integer'],
            "quantity_xl" => ['nullable', 'integer'],
            "quantity_xxl" => ['nullable', 'integer'],
        ]);

        if (!Product::where([
            ["name", $request->name],
            ["category_id", $request->category_id],
            ["catalog_id", $request->catalog_id],
        ])->first()) {
            $product = new Product();
            $product->catalog_id = $request->catalog_id;
            $product->category_id = $request->category_id;
            $product->name = strtolower($request->name);
            $product->price = $request->price;
            $product->description = strtolower($request->description);
            $product->color = strtolower($request->color);
            $product->img_thumbnail = [$request->thumbnail_one->getClientOriginalName(), $request->thumbnail_two->getClientOriginalName()];

            $images = [$request->picture_one->getClientOriginalName()];
            if($request->picture_two) $images[] = $request->picture_two->getClientOriginalName();
            if($request->picture_three) $images[] = $request->picture_three->getClientOriginalName();
            if($request->picture_four) $images[] = $request->picture_four->getClientOriginalName();
            $product->img_fullsize = $images;

            $quantity_per_size = [];
            if($request->quantity_s) $quantity_per_size[] = ["s", $request->quantity_s];
            if($request->quantity_m) $quantity_per_size[] = ["m", $request->quantity_m];
            if($request->quantity_l) $quantity_per_size[] = ["l", $request->quantity_l];
            if($request->quantity_xl) $quantity_per_size[] = ["xl", $request->quantity_xl];
            if($request->quantity_xxl) $quantity_per_size[] = ["xxl", $request->quantity_xxl];
            $product->quantity_per_size = $quantity_per_size;
            
            $product->save();
        } else {
            return Redirect::back()->withErrors(['msg' => 'Erreur. Ce produit existe déjà.']);
        }

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug1, $slug2, $slug3 = 0)
    {
        $catalog = null;

        if (strpos(url()->current(), 'woman') && Catalog::where("gender", "Femme")->first()) {
            $catalog = Catalog::where("gender", "Femme")->first()->id;
        } else if (strpos(url()->current(), 'men') && Catalog::where("gender", "Homme")->first()) {
            $catalog = Catalog::where("gender", "Homme")->first()->id;
        }

        $product = Product::where([
            ["name", $slug2],
            ['catalog_id', $catalog],
        ])->first();
        $options = Option::where("id", $slug3)->first();
        $sizes = Size::where("option_id", $options->id)->get();

        return view('products/product', [
            "product" => $product,
            "options" => $options,
            "sizes" => $sizes,
        ]);
    }

    public function getQuantity(Request $request)
    {
        try {
            $size = Size::where([
                ["size", $request->size],
                ["option_id", $request->option_id],
            ])->first()->quantity;

            return response()->json([
                'size' => $size,
            ]);
        } catch (Exception $e) {
            http_response_code(500);

            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}

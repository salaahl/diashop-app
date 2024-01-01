<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Option;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Size;
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
        $categories = Category::all();
        $brands = Brand::all();

        return view('manage/add-product', [
            "catalogs" => $catalogs,
            "categories" => $categories,
            "brands" => $brands
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
            "brand_id" => ['required', 'integer'],
            "price" => ['required', 'numeric'],
            "description" => ['required', 'string', 'min:2', 'max:400'],
        ]);

        if (!Product::where([
            ["name", $request->name],
            ["brand_id", $request->brand_id],
            ["category_id", $request->category_id],
            ["catalog_id", $request->catalog_id],
        ])->first()) {
            $product = new Product();
            $product->catalog_id = $request->catalog_id;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->save();
        } else {
            return Redirect::back()->withErrors(['msg' => 'Erreur. Ce produit existe déjà.']);
        }

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug1, $slug2 = 0)
    {
        $catalog = null;

        if (strpos(url()->current(), 'woman') && Catalog::where("gender", "Femme")->first()) {
            $catalog = Catalog::where("gender", "Femme")->first()->id;
        } else if (strpos(url()->current(), 'men') && Catalog::where("gender", "Homme")->first()) {
            $catalog = Catalog::where("gender", "Homme")->first()->id;
        }

        $product = Product::where([
            ["name", $slug1],
            ['catalog_id', $catalog],
        ])->first();
        $options = $product->options[$slug2];

        return view('products/product', [
            "product" => $product,
            "options" => $options,
            "sizes" => $options->sizes,
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

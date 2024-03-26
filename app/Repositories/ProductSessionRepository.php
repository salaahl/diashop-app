<?php

namespace App\Repositories;

use App\Models\Product;

class ProductSessionRepository implements ProductInterfaceRepository
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store($request)
    {
        $product = new Product();
        $product->catalog_id = $request->catalog_id;
        $product->category_id = $request->category_id;
        $product->name = strtolower($request->name);
        $product->price = $request->price;
        if ($request->promotion) $product->promotion = $request->promotion;
        $product->description = strtolower($request->description);

        $images = [$request->img_one, $request->img_two];
        if ($request->img_three) $images[] = $request->img_three;
        if ($request->img_four) $images[] = $request->img_four;
        $product->img = $images;

        $quantity_per_size = [];
        if ($request->quantity_os) $quantity_per_size["os"] = $request->quantity_os;
        if ($request->quantity_s) $quantity_per_size["s"] = $request->quantity_s;
        if ($request->quantity_m) $quantity_per_size["m"] = $request->quantity_m;
        if ($request->quantity_l) $quantity_per_size["l"] = $request->quantity_l;
        if ($request->quantity_xl) $quantity_per_size["xl"] = $request->quantity_xl;
        if ($request->quantity_xxl) $quantity_per_size["xxl"] = $request->quantity_xxl;
        $product->quantity_per_size = $quantity_per_size;

        $product->save();
    }

    public function show($request)
    {
        //
    }

    public function getQuantity($request)
    {
        //
    }

    public function edit()
    {
        //
    }

    public function update($product_id, $request)
    {
        $product = Product::where("id", $product_id)->first();

        $product->catalog_id = $request->catalog_id;
        $product->category_id = $request->category_id;
        $product->name = strtolower($request->name);
        $product->price = $request->price;
        if ($request->promotion) $product->promotion = $request->promotion;
        $product->description = strtolower($request->description);

        $images = [$request->img_one, $request->img_two];
        if ($request->img_three) $images[] = $request->img_three;
        if ($request->img_four) $images[] = $request->img_four;
        $product->img = $images;

        $quantity_per_size = [];
        if ($request->quantity_s) $quantity_per_size["s"] = $request->quantity_s;
        if ($request->quantity_m) $quantity_per_size["m"] = $request->quantity_m;
        if ($request->quantity_l) $quantity_per_size["l"] = $request->quantity_l;
        if ($request->quantity_xl) $quantity_per_size["xl"] = $request->quantity_xl;
        if ($request->quantity_xxl) $quantity_per_size["xxl"] = $request->quantity_xxl;
        $product->quantity_per_size = $quantity_per_size;

        $product->save();
    }

    public function destroy()
    {
        //
    }
}

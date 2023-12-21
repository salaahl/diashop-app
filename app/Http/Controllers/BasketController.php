<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function show(Product $product)
    {
        return view('basket');
    }

    public function update(Product $product)
    {
        //
    }

    public function delete(Product $product)
    {
        //
    }
}

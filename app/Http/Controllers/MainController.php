<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(Product $product)
    {
        return view('home');
    }

    public function catalog(Product $product)
    {
        return view('products/catalog');
    }
}

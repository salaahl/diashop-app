<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(Product $product)
    {
        $woman_catalog = null;
        $men_catalog = null;

        if (Catalog::where("gender", "Femme")->first()) {
            $woman_catalog = Catalog::where("gender", "Femme")->first()->id;
        }

        if (Catalog::where("gender", "Homme")->first()) {
            $men_catalog = Catalog::where("gender", "Homme")->first()->id;
        }

        $woman_products = Product::where("catalog_id", $woman_catalog)->orderBy('created_at', 'DESC')->limit(4)->get();
        $men_products = Product::where("catalog_id", $men_catalog)->orderBy('created_at', 'DESC')->limit(4)->get();

        return view('home', [
            "woman_products" => $woman_products,
            "men_products" => $men_products
        ]);
    }

    public function catalog(Request $request, Catalog $catalog)
    {
        $h1 = null;
        $h2 = null;

        if (url()->current() == route('woman.catalog') && Catalog::where("gender", "Femme")->first()) {
            $catalog = Catalog::where("gender", "Femme")->first()->id;
            $h1 = "Femme";
            $h2 = "Découvrez notre collection féminine : élégance, style et confiance !";
        } else if (url()->current() == route('men.catalog') && Catalog::where("gender", "Homme")->first()) {
            $catalog = Catalog::where("gender", "Homme")->first()->id;
            $h1 = "Homme";
            $h2 = "Découvrez notre collection masculine : élégance, sophistication et confiance !";
        }

        switch ($request->filter) {
            case "new":
                $products = Product::where("catalog_id", $catalog)->orderBy('created_at', 'ASC')->paginate(12);
                break;
            case "price-lowest":
                $products = Product::where("catalog_id", $catalog)->orderBy('price', 'ASC')->paginate(12);
                break;
            case "price-highest":
                $products = Product::where("catalog_id", $catalog)->orderBy('price', 'DESC')->paginate(12);
                break;
            default:
                $products = Product::where("catalog_id", $catalog)->orderBy('created_at', 'ASC')->paginate(12);
        }

        $categories = [];

        foreach ($products as $product) {
            if (!in_array($product->category->name, $categories)) {
                $categories[] = $product->category->name;
            }
        }

        return view('products/catalog', [
            "products" => $products,
            "h1" => $h1,
            "h2" => $h2,
            "categories" => $categories
        ]);
    }
}

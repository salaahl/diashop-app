<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Option;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $woman_catalog = null;
        $men_catalog = null;

        if (Catalog::where("gender", "Femme")->first()) {
            $woman_catalog = Catalog::where("gender", "Femme")->first()->id;
        }

        if (Catalog::where("gender", "Homme")->first()) {
            $men_catalog = Catalog::where("gender", "Homme")->first()->id;
        }

        $woman_options = Option::where(
            "product_id",
            Product::where("catalog_id", $woman_catalog)->first()->id
        )->orderBy('created_at', 'DESC')->limit(5)->get();

        $men_options = Option::where(
            "product_id",
            Product::where("catalog_id", $men_catalog)->first()->id
        )->orderBy('created_at', 'DESC')->limit(5)->get();

        return view('home', [
            "woman_options" => $woman_options,
            "men_options" => $men_options
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

        return view('products/catalog', [
            "products" => $products,
            "h1" => $h1,
            "h2" => $h2,
            "categories" => Category::where("catalog_id", $catalog)->get()
        ]);
    }
}

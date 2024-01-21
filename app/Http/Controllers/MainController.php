<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Option;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function catalog(Request $request, Catalog $catalog)
    {
        $h1 = null;
        $h2 = null;
        $meta_description = null;

        if (url()->current() == route('woman.catalog') && Catalog::where("gender", "Femme")->first()) {
            $catalog = Catalog::where("gender", "Femme")->first()->id;
            $h1 = "Femme";
            $h2 = "Découvrez notre collection féminine : élégance, style et confiance !";
            $meta_description = "Découvrez notre collection de prêt-à-porter pour hommes. Trouvez des vêtements tendance, élégants et de haute qualité pour compléter votre style.";
        } else if (url()->current() == route('men.catalog') && Catalog::where("gender", "Homme")->first()) {
            $catalog = Catalog::where("gender", "Homme")->first()->id;
            $h1 = "Homme";
            $h2 = "Découvrez notre collection masculine : élégance, sophistication et confiance !";
            $meta_description = "Découvrez notre collection de prêt-à-porter pour femmes. Trouvez des vêtements tendance, élégants et de haute qualité pour compléter votre style.";
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
            "categories" => Category::where("catalog_id", $catalog)->get(),
            "meta_description" => $meta_description
        ]);
    }

    public function category($slug, Request $request, Catalog $catalog)
    {
        $h1 = null;
        $h2 = null;

        if (url()->current() == route('woman.category', $slug) && Catalog::where("gender", "Femme")->first()) {
            $catalog = Catalog::where("gender", "Femme")->first()->id;
            $h1 = "Femme";
            $h2 = "Découvrez notre collection féminine : élégance, style et confiance !";
        } else if (url()->current() == route('men.category', $slug) && Catalog::where("gender", "Homme")->first()) {
            $catalog = Catalog::where("gender", "Homme")->first()->id;
            $h1 = "Homme";
            $h2 = "Découvrez notre collection masculine : élégance, sophistication et confiance !";
        }

        switch ($request->filter) {
            case "new":
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog)
                        ->where("name", $slug)
                        ->first()->id
                )->orderBy('created_at', 'ASC')->paginate(12);
                break;
            case "price-lowest":
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog)
                        ->where("name", $slug)
                        ->first()->id
                )->orderBy('price', 'ASC')->paginate(12);
                break;
            case "price-highest":
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog)
                        ->where("name", $slug)
                        ->first()->id
                )->orderBy('price', 'DESC')->paginate(12);
                break;
            default:
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog)
                        ->where("name", $slug)
                        ->first()->id
                )->orderBy('created_at', 'ASC')->paginate(12);
        }

        return view('products/catalog', [
            "products" => $products,
            "h1" => $h1,
            "h2" => $h2,
            "categories" => Category::where("catalog_id", $catalog)->get()
        ]);
    }
}

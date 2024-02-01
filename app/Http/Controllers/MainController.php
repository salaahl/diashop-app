<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Exception;

class MainController extends Controller
{
    public function catalog(Request $request, Catalog $catalog)
    {
        $query = explode("/", url()->current());
        $catalog_name = $query[3] == "woman" ? "femme" : "homme";
        $catalog_id = Catalog::where("gender", $catalog_name)->first()->id;
        $categories = Category::where("catalog_id", $catalog_id)->get();

        switch ($request->filter) {
            case "new":
                $products = Product::where("catalog_id", $catalog_id)->orderBy('created_at', 'ASC')->paginate(12);
                break;
            case "price-lowest":
                $products = Product::where("catalog_id", $catalog_id)->orderBy('price', 'ASC')->paginate(12);
                break;
            case "price-highest":
                $products = Product::where("catalog_id", $catalog_id)->orderBy('price', 'DESC')->paginate(12);
                break;
            default:
                $products = Product::where("catalog_id", $catalog_id)->orderBy('created_at', 'ASC')->paginate(4);
        }

        return view('products/list', [
            "products" => $products,
            "categories" => $categories,
        ]);
    }

    public function category($slug, Request $request, Catalog $catalog)
    {
        $query = explode("/", url()->current());
        $catalog_name = $query[3] == "woman" ? "femme" : "homme";
        $catalog_id = Catalog::where("gender", $catalog_name)->first()->id;
        $categories = Category::where("catalog_id", $catalog_id)->get();

        switch ($request->filter) {
            case "new":
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $slug)
                        ->first()->id
                )->orderBy('created_at', 'ASC')->paginate(12);
                break;
            case "price-lowest":
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $slug)
                        ->first()->id
                )->orderBy('price', 'ASC')->paginate(12);
                break;
            case "price-highest":
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $slug)
                        ->first()->id
                )->orderBy('price', 'DESC')->paginate(12);
                break;
            default:
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $slug)
                        ->first()->id
                )->orderBy('created_at', 'ASC')->paginate(12);
        }

        return view('products/list', [
            "products" => $products,
            "categories" => $categories
        ]);
    }

    public function search($input, $catalog_id)
    {
        $catalog = Catalog::where("id", $catalog_id)->get();

        $products = Product::where([
            ["name", "like", "%" . $input . "%"],
            ["catalog_id", $catalog_id],
        ])->limit(5)->get();

        return view('products/list', [
            'catalog' => $catalog,
            "products" => $products
        ]);
    }

    public function searchAsync(Request $request)
    {
        try {
            $results = [];
            $catalog = Catalog::where("id", $request->catalog_id)->first();
            $products = Product::where([
                ["name", "like", "%" . $request->input . "%"],
                ["catalog_id", $catalog->id],
            ])->limit(5)->get();

            foreach ($products as $product) {
                $results[] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "category" => $product->category->name,
                    "img_thumbnail" => [
                        0 => $product->img_thumbnail[0],
                        1 => $product->img_thumbnail[1]
                    ],
                    "price" => $product->price,
                ];
            }

            return response()->json([
                'catalog' => $catalog,
                'results' => $results
            ]);
            http_response_code(200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
            http_response_code(500);
        }
    }
}

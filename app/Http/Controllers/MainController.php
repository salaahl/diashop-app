<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Option;
use Illuminate\Http\Request;
use Exception;

class MainController extends Controller
{
    public function catalog(Request $request, Catalog $catalog)
    {
        $products = null;
        $query = explode("/", url()->current());
        $catalog_name = $query[2] == "woman" ? "femme" : "homme";
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
                $products = Product::where("catalog_id", $catalog_id)->orderBy('created_at', 'ASC')->paginate(12);
        }

        return view('products/catalog', [
            "products" => $products,
            "categories" => $categories,
        ]);
    }

    public function category($slug, Request $request, Catalog $catalog)
    {
        $products = null;
        $query = explode("/", url()->current());
        $catalog_name = $query[2] == "woman" ? "femme" : "homme";
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

        return view('products/catalog', [
            "products" => $products,
            "categories" => $categories
        ]);
    }

    public function search(Request $request)
    {
        $result = [];

        try {
            $products = Product::where([
                ["name", "like", "%" . $request->input . "%"],
                ["catalog_id", $request->catalog_id],
            ])->limit(3)->get();

            $index = 0;

            foreach ($products as $product) {
                if (count($product->options) > 1) {
                    for ($i = 0; $i < count($product->options); $i++) {
                        if ($index <= 5) {
                            $result[] = [
                                "gender" => $product->catalog->gender,
                                "category" => $product->category->name,
                                "name" => $product->name,
                                "option_id" => $product->options[$i]->id,
                                "img_thumbnail" => [
                                    0 => $product->options[$i]->img_thumbnail[0],
                                    1 => $product->options[$i]->img_thumbnail[1]
                                ],
                                "price" => $product->price,
                            ];
                        }
                        $index = $index + 1;
                    }
                } else {
                    if ($index <= 5) {
                        $result[] = [
                            "gender" => $product->catalog->gender,
                            "category" => $product->category->name,
                            "name" => $product->name,
                            "option_id" => $product->options[0]->id,
                            "img_thumbnail" => [
                                0 => $product->options[0]->img_thumbnail[0],
                                1 => $product->options[0]->img_thumbnail[1]
                            ],
                            "price" => $product->price,
                        ];
                        $index = $index + 1;
                    }
                }
            }

            return response()->json([
                'result' => $result,
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

<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Exception;

class MainController extends Controller
{
    public function catalog($catalog, Request $request)
    {
        dd(session()->all());
        $catalog_id = Catalog::where("name", $catalog)->first()->id;
        $categories = Category::where("catalog_id", $catalog_id)->get();

        switch ($request->filter) {
            case "new":
                $products = Product::where("catalog_id", $catalog_id)->orderBy('created_at', 'DESC')->paginate(12);
                break;
            case "price-lowest":
                $products = Product::where("catalog_id", $catalog_id)->orderBy('price', 'ASC')->paginate(12);
                break;
            case "price-highest":
                $products = Product::where("catalog_id", $catalog_id)->orderBy('price', 'DESC')->paginate(12);
                break;
            default:
                $products = Product::where("catalog_id", $catalog_id)->orderBy('created_at', 'DESC')->paginate(12);
        }

        return view('products/list', [
            "products" => $products,
            "categories" => $categories,
        ]);
    }

    public function category($catalog, $category, Request $request)
    {
        $catalog_id = Catalog::where("name", $catalog)->first()->id;
        $categories = Category::where("catalog_id", $catalog_id)->get();

        switch ($request->filter) {
            case "new":
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $category)
                        ->first()->id
                )->orderBy('created_at', 'DESC')->paginate(12);
                break;
            case "price-lowest":
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $category)
                        ->first()->id
                )->orderBy('price', 'ASC')->paginate(12);
                break;
            case "price-highest":
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $category)
                        ->first()->id
                )->orderBy('price', 'DESC')->paginate(12);
                break;
            default:
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $category)
                        ->first()->id
                )->orderBy('created_at', 'DESC')->paginate(12);
        }

        return view('products/list', [
            "products" => $products,
            "categories" => $categories
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function product($catalog, $category, $product_id)
    {
        $product = Product::where('id', $product_id)->first();

        return view('products/product', [
            "product" => $product
        ]);
    }

    public function search($catalog, $input)
    {
        $catalog = Catalog::where("name", $catalog)->first();
        $products = Product::where([
            ["name", "like", "%" . $input . "%"],
            ["catalog_id", $catalog->id],
        ])->paginate(12);

        return view('products/list', [
            "products" => $products
        ]);
    }

    public function searchAsync(Request $request)
    {
        try {
            $results = [];
            $catalog = Catalog::where("name", $request->catalog)->first();
            $products = Product::where([
                ["name", "like", "%" . $request->input . "%"],
                ["catalog_id", $catalog->id],
            ])->limit(5)->get();

            foreach ($products as $product) {
                $results[] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "category" => $product->category->name,
                    "img" => [
                        0 => $product->img[0],
                        1 => $product->img[1]
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

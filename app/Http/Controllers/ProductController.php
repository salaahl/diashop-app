<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Exception;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected ProductService $productService; // L'instance ProductService

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function home()
    {
        $catalogs = Catalog::all();
        $new_products = Product::orderBy('created_at', 'desc')->take(3)->get();

        return view('home', [
            "catalogs" => $catalogs,
            "new_products" => $new_products
        ]);
    }

    public function catalog($catalog, Request $request)
    {
        try {
            $catalog_id = Catalog::where("name", $catalog)->first()->id;
            $categories = Category::where("catalog_id", $catalog_id)->get();
            $products = $this->productService->getProductsByFilter(
                $catalog_id,
                $request->sizes,
                $request->sort_by,
            );

            return view('products/list', [
                "categories" => $categories,
                "products" => $products
            ]);
        } catch (Exception $e) {
            return redirect()->route('catalog', $catalog)->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function category($catalog, $category, Request $request)
    {
        try {
            $catalog_id = Catalog::where("name", $catalog)->first()->id;
            $categories = Category::where("catalog_id", $catalog_id)->get();
            $products = $this->productService->getProductsByCategoryAndFilter(
                $catalog_id,
                $category,
                $request->sizes,
                $request->sort_by,
            );

            return view('products/list', [
                "categories" => $categories,
                "products" => $products
            ]);
        } catch (Exception $e) {
            return redirect()->route('catalog', $catalog)->with(
                'error',
                'Erreur lors du chargement. Veuillez réessayer.'
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function product($catalog, $category, $product_id)
    {
        try {
            $product = Product::where([
                ['catalog_id', Catalog::where('name', $catalog)->first()->id],
                ['category_id', Category::where([
                    ['name', $category],
                    ['catalog_id', Catalog::where('name', $catalog)->first()->id]
                ])->first()->id],
                ['id', $product_id]
            ])->first();
        } catch (Exception $e) {
            return redirect()->route('404');
        }

        return view('products/product', [
            "product" => $product
        ]);
    }

    public function productStock(Request $request)
    {
        try {
            $quantity = Product::find($request->product_id)->quantity_per_size;

            return response()->json([
                'quantity' => $quantity[$request->size]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
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
            $products = $this->productService->searchProductsAsync($request->catalog, $request->input);

            return response()->json([
                'results' => $products
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}

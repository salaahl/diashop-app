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
        $new_products = Product::selectRaw('*, (price - (price * COALESCE(promotion, 0) / 100)) AS final_price')
            ->orderBy('created_at', 'desc')->take(3)->get();

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
            $products = $this->productService->getProductsByCatalog(
                $catalog_id,
                $request->size,
                $request->sort_by,
            );
        } catch (Exception $e) {
            return redirect()->route('catalog', $catalog)->with(
                'error',
                $e->getMessage()
            );
        }

        return view('products/list', [
            "categories" => $categories,
            "products" => $products
        ]);
    }

    public function category($catalog, $category, Request $request)
    {
        try {
            $catalog_id = Catalog::where("name", $catalog)->first()->id;
            $categories = Category::where("catalog_id", $catalog_id)->get();
            $products = $this->productService->getProductsByCategory(
                $catalog_id,
                $category,
                $request->size,
                $request->sort_by,
            );
        } catch (Exception $e) {
            return redirect()->route('catalog', $catalog)->with(
                'error',
                $e->getMessage()
            );
        }

        return view('products/list', [
            "categories" => $categories,
            "products" => $products
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function product($catalog, $category, $product_id)
    {
        $product = Product::selectRaw('*, (price - (price * COALESCE(promotion, 0) / 100)) AS final_price')
            ->where([
                ['catalog_id', Catalog::where('name', $catalog)->first()->id],
                ['category_id', Category::where([
                    ['name', $category],
                    ['catalog_id', Catalog::where('name', $catalog)->first()->id]
                ])->first()->id],
                ['id', $product_id]
            ])->first();

        if (!$product) {
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
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'quantity' => $quantity[$request->size]
        ]);
    }

    public function search(Request $request, $catalog, $input)
    {
        try {
            $catalog = Catalog::where("name", $catalog)->first();
            $products = $this->productService->getProductsByQuery(
                $catalog->id,
                $input,
                $request->size,
                $request->sort_by,
            );
        } catch (Exception $e) {
            return redirect()->route('catalog', $catalog->id)->with(
                'error',
                'Erreur lors du chargement. Veuillez réessayer.'
            );
        }

        return view('products/list', [
            "products" => $products
        ]);
    }

    public function searchAsync(Request $request)
    {
        try {
            $products = $this->productService->searchProductsAsync($request->catalog, $request->input);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'results' => $products
        ]);
    }
}

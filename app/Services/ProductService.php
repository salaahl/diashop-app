<?php

namespace App\Services;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Product;
use Exception;

class ProductService
{
    public function filterProductsBySize($products, $size)
    {
        if ($size) {
            $products = $products->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(quantity_per_size, '$.\"$size\"')) > 0");
        }

        return $products->paginate(12);
    }


    public function getProductsByCatalog($catalog_id, $size, $sort_by)
    {
        switch ($sort_by) {
            case "new":
                $products = Product::where("catalog_id", $catalog_id)->selectRaw('*, (price - (price * COALESCE(promotion, 0) / 100)) AS final_price')->orderBy('created_at', 'DESC');
                break;
            case "price-lowest":
                $products = Product::where("catalog_id", $catalog_id)->selectRaw('*, (price - (price * COALESCE(promotion, 0) / 100)) AS final_price')->orderBy('final_price', 'ASC');
                break;
            case "price-highest":
                $products = Product::where("catalog_id", $catalog_id)->selectRaw('*, (price - (price * COALESCE(promotion, 0) / 100)) AS final_price')->orderBy('final_price', 'DESC');
                break;
            default:
                $products = Product::where("catalog_id", $catalog_id)->selectRaw('*, (price - (price * COALESCE(promotion, 0) / 100)) AS final_price')->orderBy('created_at', 'DESC');
        }

        $products = $this->filterProductsBySize($products, $size);

        if (!$products) {
            throw new Exception("Aucun résultat");
        }

        return $products;
    }

    public function getProductsByCategory($catalog_id, $category, $size, $sort_by)
    {
        switch ($sort_by) {
            case "new":
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $category)
                        ->first()->id
                )
                    ->selectRaw('*, (price - (price * COALESCE(promotion, 0) / 100)) AS final_price')
                ->orderBy('created_at', 'DESC');
                break;
            case "price-lowest":
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $category)
                        ->first()->id
                )
                ->selectRaw('*, (price - (price * COALESCE(promotion, 0) / 100)) AS final_price')
                ->orderBy('final_price', 'ASC');
                break;
            case "price-highest":
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $category)
                        ->first()->id
                )
                ->selectRaw('*, (price - (price * COALESCE(promotion, 0) / 100)) AS final_price')
                ->orderBy('final_price', 'DESC');
                break;
            default:
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $category)
                        ->first()->id
                )
                ->selectRaw('*, (price - (price * COALESCE(promotion, 0) / 100)) AS final_price')
                ->orderBy('created_at', 'DESC');
        }

        $products = $this->filterProductsBySize($products, $size);

        if (!$products) {
            throw new Exception("Aucun résultat");
        }

        return $products;
    }

    public function getProductsByQuery($catalog_id, $input, $size, $sort_by)
    {
        switch ($sort_by) {
            case "new":
                $products = Product::where([
                    ["name", "like", "%" . $input . "%"],
                    ["catalog_id", $catalog_id],
                ])
                ->selectRaw('*, (price - (price * COALESCE(promotion, 0) / 100)) AS final_price')
                ->orderBy('created_at', 'DESC');
                break;
            case "price-lowest":
                $products = Product::where([
                    ["name", "like", "%" . $input . "%"],
                    ["catalog_id", $catalog_id],
                ])
                ->selectRaw('*, (price - (price * COALESCE(promotion, 0) / 100)) AS final_price')
                ->orderBy('final_price', 'ASC');
                break;
            case "price-highest":
                $products = Product::where([
                    ["name", "like", "%" . $input . "%"],
                    ["catalog_id", $catalog_id],
                ])
                ->selectRaw('*, (price - (price * COALESCE(promotion, 0) / 100)) AS final_price')
                ->orderBy('final_price', 'DESC');
                break;
            default:
                $products = Product::where([
                    ["name", "like", "%" . $input . "%"],
                    ["catalog_id", $catalog_id],
                ])
                ->selectRaw('*, (price - (price * COALESCE(promotion, 0) / 100)) AS final_price')
                ->orderBy('created_at', 'DESC');
        }

        $products = $this->filterProductsBySize($products, $size);

        if (!$products) {
            throw new Exception("Aucun résultat");
        }

        return $products;
    }

    public function searchProductsAsync($catalog, $input)
    {
        $results = [];
        $catalog = Catalog::where("name", $catalog)->first();
        $products = Product::where([
            ["name", "like", "%" . $input . "%"],
            ["catalog_id", $catalog->id],
        ])->limit(5)->get();

        foreach ($products as $product) {
            $product_images = $product->img;
            $product_stock = 0;
            $quantity_per_size = $product->quantity_per_size;
            foreach ($quantity_per_size as $size => $quantity) {
                $product_stock += $quantity;
            }

            $results[] = [
                "id" => $product->id,
                "name" => $product->name,
                "category" => $product->category->name,
                "img" => [
                    0 => $product_images[0],
                    1 => $product_images[1]
                ],
                "message" => $product_stock ? "" : "Ce produit est en rupture de stock"
            ];
        }

        if (count($results) === 0) {
            throw new Exception("Aucun résultat");
        }

        return $results;
    }
}

<?php

namespace App\Services;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Product;

class ProductService
{
    public function filterProductsBySize($products, $sizes)
    {
        if ($sizes && count($sizes) < 5) {
            $products = $products->where(function ($query) use ($sizes) {
                foreach ($sizes as $size) {
                    $query->orwhereRaw("JSON_UNQUOTE(JSON_EXTRACT(quantity_per_size, '$.\"$size\"')) > 0");
                }
            });
        }

        return $products->paginate(12);
    }


    public function getProductsByFilter($catalog_id, $sizes, $sort_by)
    {
        switch ($sort_by) {
            case "new":
                $products = Product::where("catalog_id", $catalog_id)->orderBy('created_at', 'DESC');
                break;
            case "price-lowest":
                $products = Product::where("catalog_id", $catalog_id)->orderBy('price', 'ASC');
                break;
            case "price-highest":
                $products = Product::where("catalog_id", $catalog_id)->orderBy('price', 'DESC');
                break;
            default:
                $products = Product::where("catalog_id", $catalog_id)->orderBy('created_at', 'DESC');
        }

        $products = $this->filterProductsBySize($products, $sizes);

        return $products;
    }

    public function getProductsByCategoryAndFilter($catalog_id, $category, $sizes, $sort_by)
    {
        switch ($sort_by) {
            case "new":
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $category)
                        ->first()->id
                )->orderBy('created_at', 'DESC');
                break;
            case "price-lowest":
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $category)
                        ->first()->id
                )->orderBy('price', 'ASC');
                break;
            case "price-highest":
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $category)
                        ->first()->id
                )->orderBy('price', 'DESC');
                break;
            default:
                $products = Product::where(
                    "category_id",
                    Category::where("catalog_id", $catalog_id)
                        ->where("name", $category)
                        ->first()->id
                )->orderBy('created_at', 'DESC');
        }

        $products = $this->filterProductsBySize($products, $sizes);

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
            $product_images = json_decode($product->img, true);
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

        return $results;
    }
}

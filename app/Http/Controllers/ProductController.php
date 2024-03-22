<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\ProductInterfaceRepository;
use App\Repositories\ProductSessionRepository;

class ProductController extends Controller
{
    protected ProductSessionRepository $productRepository; // L'instance ProductSessionRepository

    public function __construct(ProductInterfaceRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catalogs = Catalog::all();

        return view('administrator/add/product', [
            "catalogs" => $catalogs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ['required', 'string', 'min:2', 'max:60'],
            "catalog_id" => ['required', 'integer'],
            "category_id" => ['required', 'integer'],
            "price" => ['required', 'numeric'],
            "description" => ['required', 'string', 'min:2', 'max:400'],
            "img_one" => ['required', 'string'],
            "img_two" => ['required', 'string'],
            "img_three" => ['nullable', 'string'],
            "img_four" => ['nullable', 'string'],
            "quantity_os" => ['nullable', 'integer'],
            "quantity_s" => ['nullable', 'integer'],
            "quantity_m" => ['nullable', 'integer'],
            "quantity_l" => ['nullable', 'integer'],
            "quantity_xl" => ['nullable', 'integer'],
            "quantity_xxl" => ['nullable', 'integer'],
        ]);

        if (!Product::where([
            ["name", $request->name],
            ["category_id", $request->category_id],
            ["catalog_id", $request->catalog_id],
        ])->first()) {
            $this->productRepository->store($request);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Erreur. Ce produit existe déjà.']);
        }

        return redirect()->route('administrator.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $products = null;

        switch ($request->filter) {
            case "alphabetical_asc":
                $products = Product::orderBy('name', 'ASC')->paginate(12);
                break;
            case "alphabetical_desc":
                $products = Product::orderBy('name', 'DESC')->paginate(12);
                break;
            case "created_at_asc":
                $products = Product::orderBy('created_at', 'ASC')->paginate(12);
                break;
            case "created_at_desc":
                $products = Product::orderBy('created_at', 'DESC')->paginate(12);
                break;
            default:
                $products = Product::orderBy('name', 'ASC')->paginate(12);
        }

        return view('administrator/show/list', [
            "products" => $products
        ]);
    }

    public function getQuantity(Request $request)
    {
        try {
            $quantity = Product::where('id', $request->product_id)->first()->quantity_per_size[$request->size];

            return response()->json([
                'quantity' => $quantity
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($product_id)
    {
        $catalogs = Catalog::all();
        $product = Product::where("id", $product_id)->first();

        return view('administrator/add/product', [
            "catalogs" => $catalogs,
            "product" => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($product_id, Request $request)
    {
        $request->validate([
            "name" => ['required', 'string', 'min:2', 'max:60'],
            "catalog_id" => ['required', 'integer'],
            "category_id" => ['required', 'integer'],
            "price" => ['required', 'numeric'],
            "description" => ['required', 'string', 'min:2', 'max:400'],
            "img_one" => ['required', 'string'],
            "img_two" => ['required', 'string'],
            "img_three" => ['nullable', 'string'],
            "img_four" => ['nullable', 'string'],
            "quantity_s" => ['nullable', 'integer'],
            "quantity_m" => ['nullable', 'integer'],
            "quantity_l" => ['nullable', 'integer'],
            "quantity_xl" => ['nullable', 'integer'],
            "quantity_xxl" => ['nullable', 'integer'],
        ]);

        $this->productRepository->update($product_id, $request);

        return redirect()->route('administrator.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id)
    {
        Product::where("id", $product_id)->delete();

        return redirect()->route('administrator.dashboard');
    }
}

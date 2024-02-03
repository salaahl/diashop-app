<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Exception;

class CategoryController extends Controller
{
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
    public function create($category_id = null)
    {
        $catalogs = Catalog::all();

        return view('administrator/add/category', [
            "catalogs" => $catalogs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "catalog_id" => ['required', 'integer'],
            "category" => ['required', 'string', 'min:2', 'max:60'],
            "img_thumbnail" => ['required', 'file', 'mimes:jpg,jpeg,png'],
        ]);

        if (!Category::where([
            ["name", $request->category],
            ["catalog_id", $request->catalog_id],
        ])->first()) {
            $category = new Category();
            $category->name = strtolower($request->category);
            $category->img_thumbnail = $request->img_thumbnail->getClientOriginalName();
            $category->catalog_id = $request->catalog_id;
            $category->save();
        } else {
            return Redirect::back()->withErrors(['msg' => 'Erreur. Cette catégorie existe déjà.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $categories = null;

        switch ($request->filter) {
            case "alphabetical_asc":
                $categories = Category::all()->orderBy('name', 'ASC')->paginate(12);
                break;
            case "alphabetical_desc":
                $categories = Category::all()->orderBy('name', 'DESC')->paginate(12);
                break;
            case "created_at_asc":
                $categories = Category::all()->orderBy('created_at', 'ASC')->paginate(12);
                break;
            case "created_at_desc":
                $categories = Category::all()->orderBy('created_at', 'DESC')->paginate(12);
                break;
            default:
                $categories = Category::all()->orderBy('name', 'ASC')->paginate(12);
        }

        return view('administrator/show/list', [
            "categories" => $categories
        ]);
    }

    public function getCategories(Request $request)
    {
        try {
            return response()->json([
                'categories' => Category::where("catalog_id", $request->catalog_id)->get(),
            ]);
            http_response_code(200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
            http_response_code(500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($category_id)
    {
        $catalogs = Catalog::all();
        $category = Category::where("id", $category_id)->first();

        return view('administrator/add/category', [
            "catalogs" => $catalogs,
            "category" => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($category_id, Request $request)
    {
        $request->validate([
            "catalog_id" => ['required', 'integer'],
            "category" => ['required', 'string', 'min:2', 'max:60'],
            "img_thumbnail" => ['required', 'file', 'mimes:jpg,jpeg,png'],
        ]);

        $category = Category::where("id", $category_id)->first();
        $category->name = strtolower($request->category);
        $category->img_thumbnail = $request->img_thumbnail->getClientOriginalName();
        $category->catalog_id = $request->catalog_id;
        $category->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category_id)
    {
        $category = Category::where("id", $category_id)->delete();
    }
}

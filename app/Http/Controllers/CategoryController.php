<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
    public function create()
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
            "name" => ['required', 'string', 'min:2', 'max:60'],
            "img" => ['required', 'string'],
        ]);

        if (!Category::where([
            ["name", $request->name],
            ["catalog_id", $request->catalog_id],
        ])->first()) {
            $category = new Category();
            $category->name = strtolower($request->name);
            $category->img = $request->img;
            $category->catalog_id = $request->catalog_id;
            $category->save();
        } else {
            return Redirect::back()->withErrors(['msg' => 'Erreur. Cette catégorie existe déjà.']);
        }

        return redirect()->route('administrator.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $categories = null;

        switch ($request->filter) {
            case "alphabetical_asc":
                $categories = Category::orderBy('name', 'ASC')->paginate(12);
                break;
            case "alphabetical_desc":
                $categories = Category::orderBy('name', 'DESC')->paginate(12);
                break;
            case "created_at_asc":
                $categories = Category::orderBy('created_at', 'ASC')->paginate(12);
                break;
            case "created_at_desc":
                $categories = Category::orderBy('created_at', 'DESC')->paginate(12);
                break;
            default:
                $categories = Category::orderBy('name', 'ASC')->paginate(12);
        }

        $method = $request->method();

        if ($request->isMethod('post')) {
            return response()->json([
                "categories" => Category::where("catalog_id", $request->catalog_id)->orderBy('name', 'ASC')->get()
            ]);
        } else {
            return view('administrator/show/list', [
                "categories" => $categories
            ]);
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
            "name" => ['required', 'string', 'min:2', 'max:60'],
            "img" => ['required', 'string'],
        ]);

        $category = Category::where("id", $category_id)->first();
        $category->name = strtolower($request->name);
        $category->img = $request->img;
        $category->catalog_id = $request->catalog_id;
        $category->save();

        return redirect()->route('administrator.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category_id)
    {
        $category = Category::where("id", $category_id)->delete();

        return redirect()->route('administrator.dashboard');
    }
}

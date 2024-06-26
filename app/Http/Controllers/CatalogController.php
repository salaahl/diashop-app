<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CatalogController extends Controller
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
        return view('administrator/add/catalog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ['required', 'string', 'min:2', 'max:60'],
        ]);

        if (!Catalog::where("name", $request->name)->first()) {
            $catalog = new Catalog();
            $catalog->name = strtolower($request->name);
            $catalog->save();
        } else {
            return Redirect::back()->withErrors(['msg' => 'Erreur. Ce catalogue existe déjà.']);
        }

        return redirect()->route('administrator.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $catalogs = null;

        switch ($request->filter) {
            case "alphabetical_asc":
                $catalogs = Catalog::orderBy('name', 'ASC')->paginate(12);
                break;
            case "alphabetical_desc":
                $catalogs = Catalog::orderBy('name', 'DESC')->paginate(12);
                break;
            case "created_at_asc":
                $catalogs = Catalog::orderBy('created_at', 'ASC')->paginate(12);
                break;
            case "created_at_desc":
                $catalogs = Catalog::orderBy('created_at', 'DESC')->paginate(12);
                break;
            default:
                $catalogs = Catalog::orderBy('name', 'ASC')->paginate(12);
        }

        return view('administrator/show/list', [
            "catalogs" => $catalogs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($catalog_id)
    {
        $catalog = Catalog::where("id", $catalog_id)->first();

        return view('administrator/add/catalog', [
            "catalog" => $catalog
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($catalog_id, Request $request)
    {
        $request->validate([
            "name" => ['required', 'string', 'min:2', 'max:60'],
        ]);

        $catalog = Catalog::where("id", $catalog_id)->first();
        $catalog->name = strtolower($request->name);
        $catalog->save();

        return Redirect::back()->withErrors(['msg' => 'Opération effectuée avec succès !']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($catalog_id)
    {
        $catalog = Catalog::where("id", $catalog_id)->delete();

        return Redirect::back()->withErrors(['msg' => 'Opération effectuée avec succès !']);
    }
}

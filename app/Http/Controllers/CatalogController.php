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
        return view('manage/add-catalog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "gender" => ['required', 'string', 'min:2', 'max:60'],
        ]);

        if (!Catalog::where("gender", $request->gender)->first()) {
            $catalog = new Catalog();
            $catalog->gender = $request->gender;
            $catalog->save();
        } else {
            return Redirect::back()->withErrors(['msg' => 'Erreur. Ce catalogue existe déjà.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Catalog $catalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catalog $catalog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Catalog $catalog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catalog $catalog)
    {
        //
    }
}

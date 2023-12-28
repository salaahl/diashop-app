<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Option;
use Illuminate\Http\Request;

class SizeController extends Controller
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
        $options = Option::all();

        return view('manage/add-size', [
            "options" => $options,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "option_id" => ['required', 'integer'],
            "quantity_s" => ['nullable', 'integer'],
            "quantity_m" => ['nullable', 'integer'],
            "quantity_l" => ['nullable', 'integer'],
            "quantity_xl" => ['nullable', 'integer'],
            "quantity_xxl" => ['nullable', 'integer'],
        ]);

        if ($request->quantity_s > 0) {
            if (!Size::where([
                ["size", "S"],
                ["option_id", $request->option_id]
            ])->first()) {
                $size = new Size();
                $size->size = "S";
                $size->quantity = $request->quantity_s;
                $size->option_id = $request->option_id;
                $size->save();
            }
        }

        if ($request->quantity_m > 0) {
            if (!Size::where([
                ["size", "M"],
                ["option_id", $request->option_id]
            ])->first()) {
                $size = new Size();
                $size->size = "M";
                $size->quantity = $request->quantity_m;
                $size->option_id = $request->option_id;
                $size->save();
            }
        }

        if ($request->quantity_l > 0) {
            if (!Size::where([
                ["size", "L"],
                ["option_id", $request->option_id]
            ])->first()) {
                $size = new Size();
                $size->size = "L";
                $size->quantity = $request->quantity_l;
                $size->option_id = $request->option_id;
                $size->save();
            }
        }

        if ($request->quantity_xl > 0) {
            if (!Size::where([
                ["size", "XL"],
                ["option_id", $request->option_id]
            ])->first()) {
                $size = new Size();
                $size->size = "XL";
                $size->quantity = $request->quantity_xl;
                $size->option_id = $request->option_id;
                $size->save();
            }
        }

        if ($request->quantity_xxl > 0) {
            if (!Size::where([
                ["size", "XXL"],
                ["option_id", $request->option_id]
            ])->first()) {
                $size = new Size();
                $size->size = "XXL";
                $size->quantity = $request->quantity_xxl;
                $size->option_id = $request->option_id;
                $size->save();
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        //
    }
}

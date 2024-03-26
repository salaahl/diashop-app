<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Jobs\TrackingNumberEmailJob;

class OrderController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $orders = null;

        switch ($request->filter) {
            case "created_at_asc":
                $orders = Order::orderBy('created_at', 'ASC')->paginate(12);
                break;
            case "created_at_desc":
                $orders = Order::orderBy('created_at', 'DESC')->paginate(12);
                break;
            case "unprocessed_orders":
                $orders = Order::where("shipped", 0)->orderBy('created_at', 'ASC')->paginate(12);
                break;
            default:
                $orders = Order::orderBy('created_at', 'DESC')->paginate(12);
        }

        return view('administrator/show/orders', [
            "orders" => $orders
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            "order_id" => ['required', 'integer'],
            "track_number" => ['required', 'string']
        ]);

        // Envoi du numéro de suivi :
        $order = Order::where("id", $request->order_id)->first();
        $order->track_number = $request->track_number;
        $order->save();

        dispatch(new TrackingNumberEmailJob([$order, $request->track_number]));

        return redirect()->route('administrator.show.orders');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\OrderedItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return response()->json(['data' => $orders], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $created_order = Order::create([
            'user_id' => request()->user_id,
        ]);

        foreach (json_decode($request->cart) as $item) {
            $parsed_item = $item;
            OrderedItem::create([
                'order_id' => $created_order->id,
                'stock_id' => $parsed_item->size_id,
                'amount'=> $parsed_item->amount
            ]);
        }
        return response()->json(['data' => request()->cart], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $validated = request()->validate([
            // TODO validate
        ]);
        $updated_order = Order::create($validated);
        return response()->json(['data' => $updated_order], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['data' => ''], 200);
    }
}

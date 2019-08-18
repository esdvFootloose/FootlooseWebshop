<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\OrderedItem;
use App\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function MongoDB\BSON\fromJSON;


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

        $parsed_cart = json_decode($request->cart);

        foreach($parsed_cart as $item) {
            $stock_item = Stock::where('id', $item->size_id)->first();
            if ($stock_item->stock - $item->amount < 0) {
                $error_item = [
                  'stock_id' => $item->size_id,
                  'amount' => $item->amount
                ];
                return response()->json(['data' => $error_item], 406);
            }
        }

        foreach ($parsed_cart as $item) {
            OrderedItem::create([
                'order_id' => $created_order->id,
                'stock_id' => $item->size_id,
                'amount'=> $item->amount
            ]);
            $stock_item = Stock::where('id', $item->size_id)->first();
            $stock_item->amount = $stock_item->amount - $item->amount;
            $stock_item->save();
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

<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Jobs\AddToCart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->first();
        return response()->json(['data' => $cart], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'stock_id' => 'required|gte:0',
            'user_id' => 'required|gte:0',
            'amount' => 'required|gt:0'
        ]);

        $cart = Cart::firstOrNew($validated);
        $cart->expires_at = Carbon::now()->addMinutes(15);
        AddToCart::dispatchNow($cart);
        $added_item = Cart::where('stock_id', $cart->stock_id)
            ->where('user_id', $cart->user_id)
            ->where('amount', $cart->amount)
            ->where('expires_at', $cart->expires_at)
            ->first();
        if ($added_item) {
            return response()->json(['data' => $added_item], 200);
        } else {
            return response()->json(['data' => 'Error: stock insufficient'], 409);
        }
    }
}

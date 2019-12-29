<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Jobs\EditCart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $cart_items = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($cart_items as $item) {
            $item->Stock;
            $item->Stock->Item;
        }
        $cart_items;
        return response()->json(['data' => $cart_items], 200);
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
            'stock_id' => 'gte:0',
            'user_id' => 'gte:0',
            'amount' => 'gt:0',
        ]);

        // $cart = Cart::where('stock_id', $validated['stock_id'])->where('user_id', $validated['user_id'])->firstOrFail();
        // $cart = Cart::first([
        //     'stock_id' => $request->stock_id,
        //     'user_id' => $request->user_id,
        //     'amount' => $request->amount,
        // ]);

        $amount = $validated['amount'];
        unset($validated['amount']);
        $cart = Cart::firstOrNew($validated);
        $cart->amount = $amount;
        $cart->user_id = Auth::user()->id;
        $cart->expires_at = Carbon::now()->addMinutes(15)->toDateTimeString();

        EditCart::dispatchNow($cart);
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
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'stock_id' => 'gte:0',
            'user_id' => 'gte:0',
            'amount' => 'gt:0',
        ]);
        $cart = Cart::firstOrNew($validated);
        $cart->amount = 0;
        EditCart::dispatchNow($cart);
        return response()->json(['data' => ''], 200);
    }
}

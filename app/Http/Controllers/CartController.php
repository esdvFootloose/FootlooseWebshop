<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cart::where('user_id', auth()->user()->id)->first();

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Stock;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::all();
        foreach($stocks as $stock) {
            $stock->stock = $stock->stock > 0;
        }
        return response()->json(['data' => $stocks], 200);
    }

    public function indexDashboard()
    {
        $stocks = Stock::all();
        return response()->json(['data' => $stocks], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            //TODO validate
        ]);
        $createdStock = Stock::create($validated);
        return response()->json(['data' => $createdStock], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        return response()->json(['data' => $stock], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        return response()->json(['data' => $stock], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $validated = request()->validate([
            //TODO validate
        ]);
        $createdStock = Stock::update($validated);
        return response()->json(['data' => $createdStock], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return response()->json(['data' => ''], 200);
    }


}
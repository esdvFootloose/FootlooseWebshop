<?php

namespace App\Http\Controllers\Api;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        foreach($items as $item) {
            $item->stock = $item->Stock;
        }
        return response()->json(['data' => $items], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDashboard()
    {
        $items = Item::all();
        foreach($items as $item) {
            $item->stock = $item->Stock;
        }
        return response()->json(['data' => $items], 200);
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
            // TODO validate
        ]);
        // TODO handle size/stock
        $created_item = Item::create($validated);
        return response()->json(['data' => $created_item], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validated = request()->validate([
            // TODO validate
        ]);
        // TODO handle size/stock
        $updated_item = Item::update($validated);
        return response()->json(['data' => $updated_item], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(['data' => ''], 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Stock;
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
        foreach ($items as $item) {
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
        foreach ($items as $item) {
            $item->Stock;
            foreach ($item->stock as $stock) {
                $stock->OrderedItem;
            }

        }
        return response()->json(['data' => $items], 200);
    }

    public function indexStocks()
    {
        $stocks = Stock::all();
        foreach ($stocks as $stock) {
            $nr_ordered = 0;
            foreach ($stock->OrderedItem as $item) {
                $nr_ordered += $item->amount;
            }
        }
        return response()->json(['data' => $stocks], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            'name' => 'required|String',
            'description' => 'nullable|String',
            'gender' => 'required|in:Male,Female,Unisex',
            'price' => 'required|gte:0',
            'available_from' => 'date|nullable',
            'available_to' => 'date|nullable',
            'stock' => 'array|required'
        ]);

        $created_item = Item::create($validated);
        $checked_sizes = array();

        foreach ($request->stock as $item_stock) {
            $stock = new Stock();
            $stock->item_id = $created_item->id;
            foreach ($item_stock as $key => $value) {
                switch ($key) {
                    case 'size':
                        if ($stock == null) return response()->json(['data' => 'Error'], 400);
                        $stock->size = $value;
                        break;
                    case 'stock':
                        if ($stock == null || $value < 0) return response()->json(['data' => 'Error'], 400);
                        $stock->stock = $value;
                        break;
                    default:
                        break;
                }
            }
            array_push($checked_sizes, $stock);
        }
        foreach ($checked_sizes as $checked_stock) {
            $checked_stock->save();
        }
        return response()->json(['data' => $created_item], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Item $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validated = request()->validate([
            'name' => 'required|String',
            'description' => 'nullable|String',
            'gender' => 'required|in:Male,Female,Unisex',
            'price' => 'required|gte:0',
            'available_from' => 'date|nullable',
            'available_to' => 'date|nullable',
            'stock' => 'array|required'
        ]);
        $item->fill($validated);

        $checked_sizes = array();

        foreach ($request->stock as $item_stock) {
            $stock = null;
            if (sizeof($item_stock) == 3) {
                $stock = new Stock();
                $stock->item_id = $item->id;
            }
            foreach ($item_stock as $key => $value) {
                switch ($key) {
                    case 'id':
                        $stock = Stock::find($value);
                        break;
                    case 'item_id':
                        if ($stock == null) return response()->json(['data' => $stock], 400);
                        $stock->item_id = $value;
                        break;
                    case 'size':
                        if ($stock == null) return response()->json(['data' => 'Error'], 400);
                        $stock->size = $value;
                        break;
                    case 'stock':
                        if ($stock == null || $value < 0) return response()->json(['data' => 'Error'], 400);
                        $stock->stock = $value;
                        break;
                    default:
                        break;
                }
            }
            array_push($checked_sizes, $stock);
        }

        $item->save();
        foreach ($checked_sizes as $checked_stock) {
            $checked_stock->save();
        }

        return response()->json(['data' => 'OK'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Item $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(['data' => ''], 200);
    }
}

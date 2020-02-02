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
            $item->image = count($image = $item->getMedia('product')) > 0 ? $image[0]->getUrl() : '/images/placeholder.png';
        }
        return response()->json(['data' => $items], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDashboard(Request $request)
    {
        if (!$request->user()->hasRole('admin')) {
            return response()->json(['Error' => "You don't have permission"], 403);
        }
        $items = Item::all();
        foreach ($items as $item) {
            $item->Stock;
            foreach ($item->stock as $stock) {
                $stock->OrderedItem;
                $item->image = count($image = $item->getMedia('product')) > 0 ? $image[0]->getUrl() : '/images/placeholder.png';
            }

        }
        return response()->json(['data' => $items], 200);
    }

    public function indexStocks(Request $request)
    {
        if (!$request->user()->hasRole('admin')) {
            return response()->json(['Error' => "You don't have permission"], 403);
        }

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
        if (!$request->user()->hasRole('admin')) {
            return response()->json(['Error' => "You don't have permission"], 403);
        }
//        $validated = $request->validate([
//            'name' => 'required|String',
//            'description' => 'nullable|String',
//            'gender' => 'required|in:Male,Female,Unisex',
//            'price' => 'required|gte:0',
//            'image' => 'nullable|array',
//            'image[]' => 'max:10000|mimes:jpg,jpeg,png,gif',
//            'available_from' => 'date|nullable',
//            'available_to' => 'date|nullable',
//            'stock' => 'array|required'
//        ]);
        $validated = $request->validate([
            'name' => 'required|String',
            'description' => 'nullable|String',
            'gender' => 'required|in:Male,Female,Unisex',
            'price' => 'required|gte:0',
            'available_from' => 'date|nullable',
            'available_to' => 'date|nullable',
            'stock' => 'array|required'
        ]);

        $created_item = Item::create($validated);

//        foreach ($validated['image'] as $file) {
//            $created_item->addMedia($file)
//                ->toMediaCollection('product');
//        }

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

//        $validated = request()->validate([
//            'name' => 'required|String',
//            'description' => 'nullable|String',
//            'gender' => 'required|in:Male,Female,Unisex',
//            'price' => 'required|gte:0',
//            'image' => 'nullable|array',
//            'image[]' => 'max:10000|mimes:jpg,jpeg,png,gif',
//            'available_from' => 'date|nullable',
//            'available_to' => 'date|nullable',
//            'stock' => 'array|nullable',
//        ]);
        $validated = request()->validate([
            'name' => 'required|String',
            'description' => 'nullable|String',
            'gender' => 'required|in:Male,Female,Unisex',
            'price' => 'required|gte:0',
            'available_from' => 'date|nullable',
            'available_to' => 'date|nullable',
            'stock' => 'array|nullable',
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

//        foreach ($validated['image'] as $file) {
//            $item->addMedia($file)
//                ->toMediaCollection('product');
//        }

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

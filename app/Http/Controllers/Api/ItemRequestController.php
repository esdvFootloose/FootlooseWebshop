<?php

namespace App\Http\Controllers\Api;

use App\ItemRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ItemRequested;
use Illuminate\Support\Facades\Mail;

class ItemRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->user()->hasRole('admin')) {
            return response()->json(['Error' => "You don't have permission"], 403);
        }
        $item_requests = ItemRequest::all();
        foreach($item_requests as $request)
        {
            $stock = $request->Stock;
            $item = $stock->Item;
            $user = $request->User;

            $request->item = $item->name;
            $request->gender = $item->gender;
            $request->size = $stock->size;
            $request->user = $user;
        }
        return response()->json(['data' => $item_requests], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $created_item_request = ItemRequest::create([
            'user_id' => $request->user_id,
            'stock_id' => $request->size_id,
            'amount' => $request->amount
        ]);
        Mail::to(auth()->user()->email)->send(
            new ItemRequested(auth()->user()->name, $created_item_request->id)
        );
        return response()->json(['data' => $created_item_request], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ItemRequest $itemRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemRequest $itemRequest)
    {
        if (!$request->user()->hasRole('admin')) {
            return response()->json(['Error' => "You don't have permission"], 403);
        }
        $validated = request()->validate([
            // TODO validate
        ]);
        $updated_item_request = ItemRequest::create($validated);
        return response()->json(['data' => $updated_item_request], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ItemRequest $itemRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!$request->user()->hasRole('admin')) {
            return response()->json(['Error' => "You don't have permission"], 403);
        }
        $itemRequest = ItemRequest::find($id);
        if ($itemRequest) $itemRequest->delete();
        return response()->json(['data' => ''], 200);
    }
}

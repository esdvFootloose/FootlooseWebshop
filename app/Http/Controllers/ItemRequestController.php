<?php

namespace App\Http\Controllers;

use App\ItemRequest;
use Illuminate\Http\Request;

class ItemRequestController extends Controller
{
    /**
     * ItemRequestController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item_requests = ItemRequest::all();
        return response()->json(['data' => $item_requests], 200);
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
            //TODO Add validation
        ]);
        $item_request = ItemRequest::create($validated);
        return response()->json(['data' => $item_request], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemRequest  $itemRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ItemRequest $itemRequest)
    {
        return response()->json(['data' => $itemRequest], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemRequest  $itemRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemRequest $itemRequest)
    {
        return response()->json(['data' => $itemRequest], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemRequest  $itemRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemRequest $itemRequest)
    {
        $validated = request()->validate([
            //TODO Add validation
        ]);
        $savedRequest = ItemRequest::create($validated);
        return response()->json(['data' => $savedRequest], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemRequest  $itemRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemRequest $itemRequest)
    {
        $itemRequest->delete();
        return response()->json(['data' => '']);
    }
}

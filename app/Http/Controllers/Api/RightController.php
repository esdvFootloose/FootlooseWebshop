<?php

namespace App\Http\Controllers\Api;

use App\Right;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rights = Right::all();
        return response()->json(['data' => $rights], 200);
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
        $right = Right::create($validated);
        return response()->json(['data' => $right], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Right  $right
     * @return \Illuminate\Http\Response
     */
    public function show(Right $right)
    {
        return response()->json(['data' => $right], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Right  $right
     * @return \Illuminate\Http\Response
     */
    public function edit(Right $right)
    {
        return response()->json(['data' => $right], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Right  $right
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Right $right)
    {
        $validated = request()->validate([
            //TODO Add validation
        ]);
        $savedRight = Right::update($validated);
        return response()->json(['data' => $savedRight], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Right  $right
     * @return \Illuminate\Http\Response
     */
    public function destroy(Right $right)
    {
        $right->delete();
        return response()->json(['data' => ''], 200);
    }
}

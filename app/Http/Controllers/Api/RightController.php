<?php

namespace App\Http\Controllers\Api;

use App\Right;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


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
        $created_right = Right::create($validated);
        return response()->json(['data' => $created_right], 200);
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
            // TODO validate
        ]);
        $updated_right = Right::create($validated);
        return response()->json(['data' => $updated_right], 200);
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

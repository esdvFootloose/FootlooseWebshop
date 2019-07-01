<?php

namespace App\Http\Controllers\Api;

use App\UserRight;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserRightController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_rights = UserRight::all();
        return response()->json(['data' => $user_rights], 200);
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
        $createdUserRight = Stock::create($validated);
        return response()->json(['data' => $createdUserRight], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserRight  $userRight
     * @return \Illuminate\Http\Response
     */
    public function show(UserRight $userRight)
    {
        return response()->json(['data' => $userRight], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserRight  $userRight
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRight $userRight)
    {
        return response()->json(['data' => $userRight], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserRight  $userRight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRight $userRight)
    {
        $validated = request()->validate([
            //TODO validate
        ]);
        $updatedUserRight = Stock::update($validated);
        return response()->json(['data' => $updatedUserRight], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserRight  $userRight
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRight $userRight)
    {
        $userRight->delete();
        return response()->json(['data' => ''], 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\UserRight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserRightController extends Controller
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
        $user_rights = UserRight::all();
        return response()->json(['data' => $user_rights], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->user()->hasRole('admin')) {
            return response()->json(['Error' => "You don't have permission"], 403);
        }
        $validated = request()->validate([
            // TODO validate
        ]);
        $created_user_right = UserRight::create($validated);
        return response()->json(['data' => $created_user_right], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserUserRight  $user_right
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRight $user_right)
    {
        if (!$request->user()->hasRole('admin')) {
            return response()->json(['Error' => "You don't have permission"], 403);
        }
        $validated = request()->validate([
            // TODO validate
        ]);
        $updated_user_right = UserRight::create($validated);
        return response()->json(['data' => $updated_user_right], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserUserRight  $user_right
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserRight $user_right)
    {
        if (!$request->user()->hasRole('admin')) {
            return response()->json(['Error' => "You don't have permission"], 403);
        }
        $user_right->delete();
        return response()->json(['data' => ''], 200);
    }
}

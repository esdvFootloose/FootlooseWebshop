<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => ['json.response']], function () {
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return response()->json(['user' => $request->user(), 'status' => 200]);
    });

    // Public routes
    Route::post('/login', 'API\AuthController@login')->name('login');


    // Private routes
    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', 'Api\AuthController@logout')->name('logout');
    });
});



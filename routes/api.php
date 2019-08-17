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
    Route::post('/login', 'Api\AuthController@login')->name('login');


    // Private routes
    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', 'Api\AuthController@logout')->name('logout');

        Route::get('/items', 'Api\ItemController@index');
        Route::get('/itemsDashboard', 'Api\ItemController@indexDashboard');
        Route::post('/items', 'Api\ItemController@store');
        Route::patch('/items/{item}', 'Api\ItemController@update');
        Route::delete('/items/{item}', 'Api\ItemController@destroy');

        Route::get('/orders', 'Api\OrderController@index');
        Route::post('/orders', 'Api\OrderController@store');
        Route::patch('/orders/{id}', 'Api\OrderController@update');
        Route::delete('/orders/{order}', 'Api\OrderController@destroy');

        Route::get('/itemrequests', 'Api\ItemRequestController@index');
        Route::post('/itemrequests', 'Api\ItemRequestController@store');
        Route::patch('/itemrequests/{itemrequest}', 'Api\ItemRequestController@update');
        Route::delete('/itemrequests/{itemrequest}', 'Api\ItemRequestController@destroy');

        Route::get('/rights', 'Api\RightController@index');
        Route::post('/rights', 'Api\RightController@store');
        Route::patch('/rights/{right}', 'Api\RightController@update');
        Route::delete('/rights/{right}', 'Api\RightController@destroy');

        Route::get('/userrights', 'Api\UserRightController@index');
        Route::post('/userrights', 'Api\UserRightController@store');
        Route::patch('/userrights/{userright}', 'Api\UserRightController@update');
        Route::delete('/userrights/{userright}', 'Api\UserRightController@destroy');
    });
});



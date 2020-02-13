<?php

Route::post('register', 'AuthController@register');

Route::post('login', 'AuthController@login');

Route::post('recover', 'AuthController@recover');

// Product routes users
Route::get('/product/{id}', 'API\ProductController@show');
Route::get('/product', 'API\ProductController@index');
Route::post('/amazon', 'API\ProductController@storeamazon');

// User detail
Route::get('user/{id}', 'UserController@show');

// Product search
Route::post('item/{search?}', 'SearchController@index');

// Category resource
Route::apiResource('/category', 'API\CategoryController');

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::get('logout', 'AuthController@logout');
    Route::get('test', function () {
        return response()->json(['foo' => 'bar']);
    });

    // product routes
    Route::post('/product/{id}', 'API\ProductController@store');
    Route::delete('/product/{id}', 'API\ProductController@destroy');
    // User update
    Route::put('user/{id}', 'UserController@update');
});

Route::put('/product/{id}', 'API\ProductController@update');

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('API')->group(function () {
	Route::prefix('/products')->group(function () {
		Route::post('/list', 'ProductsController@listProducts');
	});
	Route::prefix('/product')->group(function () {
		Route::post('/get/{id}', 'ProductsController@getProduct');
		Route::post('/save/{id?}', 'ProductsController@saveProduct');
		Route::post('/delete/{id}', 'ProductsController@deleteProduct');
	});

	Route::prefix('/shops')->group(function () {
		Route::post('/save', 'ShopsController@saveShop');
		Route::post('/list', 'ShopsController@listShops');
		Route::post('/delete/{id?}', 'ShopsController@deleteShop');
	});
});
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

Route::prefix('/products')->group(function (){
	Route::namespace('API')->group(function () {
		Route::post('/save','ProductsController@saveProduct');
		Route::post('/list','ProductsController@listProducts');
		Route::post('/delete/{id?}','ProductsController@deleteProduct');
	});
});

Route::prefix('/shops')->group(function (){
	Route::namespace('API')->group(function () {
		Route::post('/save','ShopsController@saveShop');
		Route::post('/list','ShopsController@listShops');
		Route::post('/delete/{id?}','ShopsController@deleteShop');
	});
});

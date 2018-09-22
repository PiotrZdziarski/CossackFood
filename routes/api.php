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

//pizzas
Route::get('pizza', ['uses' => 'PizzaController@index']);
Route::get('pizza_pages', ['uses' => 'PizzaController@pages']);

//dishes
Route::get('dishes', ['uses' => 'DishController@index']);
Route::get('dishes_page', ['uses' => 'DishController@page']);

//reservations
Route::get('reservations/{date}/{time}', ['uses' => 'ReservationController@index']);
Route::post('store_reservation', ['uses' => 'ReservationController@store']);

//ordering
Route::get('basket_products', ['uses' => 'BasketProductController@index']);
Route::post('basket_store', ['uses' => 'BasketProductController@store']);
Route::post('basket_delete', ['uses' => 'BasketProductController@delete']);
Route::get('basket_delete_all', ['uses' => 'BasketProductController@delete_all']);


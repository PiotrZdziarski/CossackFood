<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// home
Route::get('/', ['uses' => 'SitesController@index']);

//pizzax
Route::get('/remove_dots', ['uses' => 'PizzaController@remove_dots']);

//dishes
Route::get('/prepare_rows_dish', ['uses' => 'DishController@prepare_rows_from_seeder']);

//menu
Route::get('/menu', ['uses' => 'SitesController@menu']);

//News
Route::get('/news', ['uses' => 'SitesController@news']);

//order
Route::get('/order', ['uses' => 'SitesController@order']);

//reservations
Route::get('/reservations', ['uses' => 'SitesController@reservations']);

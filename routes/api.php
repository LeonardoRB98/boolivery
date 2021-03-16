<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('Api')->group(function() {
    Route::get('/categories', 'CategoryController@categories'); // restituisce tutte le cit
    Route::get('/restaurants', 'RestaurantController@restaurants'); // restituisce tutte le cit per l'anno selezionato
    Route::get('/plates', 'PlateController@plates'); // restituisce tutte le cit per l'anno selezionato
    Route::get('/plates/{restaurant_id}', 'PlateController@platesInRestaurant'); //restituisce i piatti associati al ristorante
    Route::get('/restaurants/{categories}', 'RestaurantController@restaurantByCategory'); //dovrebbe restituire i ristoranti data la categoria
});

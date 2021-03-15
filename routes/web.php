<?php

use Illuminate\Support\Facades\Route;
// IMPORTO NAMESPACE
use Illuminate\Support\Facades\Auth;

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

// ROTTE PUBBLICHE
Route::get('/', 'GuestController@index')->name('home');
Route::get('/Boolivery/restaurant', 'GuestController@show')->name('restaurant');
Route::get('/Boolivery/restaurant/checkout', 'GuestController@checkout')->name('checkout');


// ROTTA INDEX HOME
// ROTTA DETTAGLIO RISTORANTE
// ROTTA CHECKOUT


// ROTTE SOTTO AUTENTICAZIONE
Auth::routes();
Route::prefix('admin') // inizio nome rotta url
    		->namespace('Admin') // cartella dove ci sono i controller
    		->middleware('auth') // autenticazione per accesso alle rotte
    		->name('admin.') // inizio nome delle rotte
    		->group(function(){

        		Route::resource('restaurants', 'RestaurantController');
                Route::get('plates/{restaurant_id}','PlateController@showPlates')->name('plates.showPlates');
                Route::get('createPlate/{restaurant_id}', 'PlateController@createPlate')->name('plates.createPlate');
                Route::resource('plates', 'PlateController');

            });



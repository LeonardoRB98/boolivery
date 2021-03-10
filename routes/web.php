<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::prefix('admin') // inizio nome rotta url
    		->namespace('Admin') // cartella dove ci sono i controller
    		->middleware('auth') // autenticazione per accesso alle rotte
    		->name('admin.') // inizio nome delle rotte
    		->group(function(){
        		Route::resource('restaurants', 'RestaurantController');
            });

Route::get('/home', 'HomeController@index')->name('home');

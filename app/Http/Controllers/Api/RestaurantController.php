<?php

namespace App\Http\Controllers\Api;
use App\Restaurant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function restaurants() {
        $restaurants = Restaurant::all();
        
        return response()->json($restaurants);
    }
}

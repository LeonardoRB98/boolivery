<?php

namespace App\Http\Controllers\Api;
use App\Restaurant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class RestaurantController extends Controller
{
    public function restaurants() {
        
        $restaurants = Restaurant::all();
        
        return response()->json($restaurants);
    }

    public function restaurantByCategory(Restaurant $restaurant , $categoryName) {

        $restaurants = Restaurant::all();

        $category = Category::where('category', $categoryName)->first();


        $restaurants = $category->restaurants;

        //  $restaurants->toArray();


        return response()->json($restaurants);
    }
}

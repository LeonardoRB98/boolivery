<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

class GuestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $restaurants = Restaurant::all();

        return view('guests.index', compact('restaurants'));
    }

    public function show($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->firstOrFail();
        // dd($restaurant);
        return view('guests.show', compact('restaurant'));
    }
    

}

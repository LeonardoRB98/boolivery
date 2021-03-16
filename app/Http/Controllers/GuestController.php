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
        $restaurant = Restaurant::all();

        return view('guests.index', compact('restaurant'));
    }

    public function show($slug)
    {   
        $restaurant = Restaurant::where('slug', $slug)->first();

        return view('guests.show', compact('restaurant'));
    }

    public function checkout()
    {
        return view('guests.checkout');
    }
    
}

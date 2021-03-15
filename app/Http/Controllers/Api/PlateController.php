<?php

namespace App\Http\Controllers\Api;
use App\Plate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlateController extends Controller
{
    public function plates() {
        $plates = Plate::all();
        return response()->json($plates);
    }

    public function platesInRestaurant($id) {
        $plates = Plate::where('restaurant_id', $id)->get();
        return response()->json($plates);
    }
}

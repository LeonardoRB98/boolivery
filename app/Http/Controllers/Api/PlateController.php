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
}

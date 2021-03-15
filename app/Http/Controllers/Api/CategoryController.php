<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories() {
        $categories = Category::all();
        
        return response()->json($categories);
    }
}

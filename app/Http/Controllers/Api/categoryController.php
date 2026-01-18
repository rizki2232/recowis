<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class categoryController extends Controller
{
    public function index(){
        return response()->json(
            Category::select('id','name')->get()
        );
    }
}

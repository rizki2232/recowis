<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserCategoryController extends Controller
{
    public function index(Request $request){
        return $request->user()->categories;
    }
}

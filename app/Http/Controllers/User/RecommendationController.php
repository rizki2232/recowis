<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\TouristSpot;
use App\Models\Category;

class RecommendationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ambil category yang dipilih user
        $categoryIds = $user->categories->pluck('id');

        // ambil wisata berdasarkan kategori tersebut
        $spots = TouristSpot::whereIn('category_id', $categoryIds)
            ->with('category')
            ->get();

        return Inertia::render('User/Recommendation', [
            'spots' => $spots
        ]);
    }
}

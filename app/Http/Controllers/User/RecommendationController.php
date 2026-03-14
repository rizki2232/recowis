<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\TouristSpot;
use App\Models\ViralTouristSpot;
use Inertia\Inertia;

class RecommendationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $categories = $user->categories->pluck('id');

        // CONTENT BASED FILTERING
        $recommendedSpots = TouristSpot::whereIn('category_id', $categories)
            ->inRandomOrder()
            ->take(3)
            ->get();


        // VIRAL SPOTS
       $viralSpots = ViralTouristSpot::with('touristSpot')
            ->orderBy('position')
            ->get();

        return Inertia::render('User/Dashboard', [
            'recommendedSpots' => $recommendedSpots,
            'viralSpots' => $viralSpots
        ]);
    }
}

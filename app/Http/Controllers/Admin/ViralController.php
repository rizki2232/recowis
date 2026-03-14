<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ViralTouristSpot;
use App\Models\TouristSpot;
use Inertia\Inertia;


class ViralController extends Controller
{
    public function index()
    {
        $viral = ViralTouristSpot::with('touristSpot')
                ->orderBy('position')
                ->get();

        $touristSpots = TouristSpot::all();

        return inertia('Admin/ViralSurabaya/Index',[
            'viral'=>$viral,
            'touristSpots'=>$touristSpots
        ]);
    }

    public function update(Request $request, $id)
{
    $viral = ViralTouristSpot::findOrFail($id);

    $viral->update([
        'tourist_spot_id' => $request->tourist_spot_id
    ]);

    return back();
}
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TouristSpot;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TouristSpotController extends Controller
{
    public function index()
    {
        return Inertia::render('admin/TouristSpot/Index', [
            'spots' => TouristSpot::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'address' => 'required',
        ]);

        TouristSpot::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
            'ticket_price' => $request->ticket_price,
            'address' => $request->address,
            'location' => $request->location,
            'created_by' => Auth::id(),
        ]);

        return back();
    }

    public function destroy(TouristSpot $touristSpot)
    {
        $touristSpot->delete();
        return back();
    }
}


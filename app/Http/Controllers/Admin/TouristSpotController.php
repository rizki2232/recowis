<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TouristSpot;
use Inertia\Inertia;
use App\Models\Category;

class TouristSpotController extends Controller
{
    // =========================
    // TAMPILKAN TABLE DATA
    // =========================a
    public function index()
    {
        return Inertia::render('Admin/TouristSpot/Index', [
            'spots' => TouristSpot::with('category')->latest()->get()
        ]);
    }

    // =========================
    // HALAMAN FORM TAMBAH
    // =========================
    public function create()
    {
        return Inertia::render('Admin/TouristSpot/Create', [
            'categories' => Category::select('id','name')->get()
        ]);
    }

    // =========================
    // SIMPAN DATA
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'address' => 'required',
        ]);

        $path = null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')
                ->store('tourist-spots', 'public');
        }

        TouristSpot::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image' => $path,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
            'ticket_price' => $request->ticket_price,
            'address' => $request->address,
            'location' => $request->location,
            'created_by' => auth()->id(),
        ]);

        return redirect('/admin/tourist-spot');
    }

    // =========================
    // HAPUS DATA
    // =========================
    public function destroy(TouristSpot $touristSpot)
    {
        $touristSpot->delete();
        return back();
    }

    public function edit(TouristSpot $touristSpot)
    {
        return Inertia::render('Admin/TouristSpot/Edit', [
            'spot' => $touristSpot,
            'categories' => Category::select('id','name')->get()
        ]);
    }


   public function update(Request $request, TouristSpot $touristSpot)
{
    $request->validate([
        'name' => 'required|string',
        'category_id' => 'required',
        'address' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $data = $request->only([
        'name',
        'category_id',
        'description',
        'open_time',
        'close_time',
        'ticket_price',
        'address',
        'location'
    ]);

    // Kalau ada gambar baru → upload & replace
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')
            ->store('tourist-spots', 'public');
    }

    // Kalau tidak ada gambar baru → field image tidak diubah
    $touristSpot->update($data);

    return redirect('/admin/tourist-spot')
        ->with('success', 'Data berhasil diupdate');
}


}

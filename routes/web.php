<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\TouristSpotController;
use App\Http\Controllers\User\RecommendationController;
use App\Models\TouristSpot;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/






Route::get('/test', fn () => Inertia::render('Auth/Login'));

// ===================
// GUEST
// ===================
// Route::middleware('guest')->group(function () {
//     Route::get('/login', fn () => Inertia::render('Auth/Login'))->name('login');
//     Route::get('/register', fn () => Inertia::render('Auth/Register'))->name('register');
//     Route::post('/login', [AuthController::class, 'login']);
// });
Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => Inertia::render('Auth/Auth'))->name('login');
    Route::get('/register', fn () => Inertia::render('Auth/Auth'))->name('register');
    Route::post('/login', [AuthController::class, 'login']);
});

// ===================
// AUTH
// ===================
Route::middleware('auth')->group(function () {

    // user
    Route::get('/dashboard', function () {

    $user = auth()->user();

    // ambil kategori favorit user
    $categoryIds = $user->categories->pluck('id');

    // ambil wisata sesuai kategori
    $recommendedSpots = TouristSpot::whereIn('category_id', $categoryIds)
        ->with('category')
        ->get();

    return Inertia::render('User/Dashboard', [
        'recommendedSpots' => $recommendedSpots
    ]);

})->middleware('role:user')->name('dashboard');
    // admin
    Route::get('/admin/dashboard', fn () =>
        Inertia::render('Admin/Dashboard')
    )->middleware('role:admin')->name('admin.dashboard');

    // root redirect
    Route::get('/', function () {
        if (auth()->user()->role === 'admin') {
            return redirect('/Admin/Dashboard');
        }
        return redirect('/Dashboard');
    });

    route::post('/logout',function(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    })->middleware ('auth')->name('logout');

});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        Route::resource('tourist-spot', TouristSpotController::class);
    });

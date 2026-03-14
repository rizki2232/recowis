<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\TouristSpotController;
use App\Http\Controllers\User\RecommendationController;
use App\Models\TouristSpot;
use App\Models\ViralTouristSpot;
use App\Http\Controllers\Admin\ViralController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/test', fn () => Inertia::render('Auth/Login'));


// ===================
// GUEST
// ===================
Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => Inertia::render('Auth/Auth'))->name('login');
    Route::get('/register', fn () => Inertia::render('Auth/Auth'))->name('register');
    Route::post('/login', [AuthController::class, 'login']);
});


// ===================
// AUTH
// ===================
Route::middleware('auth')->group(function () {

    // ===================
    // USER DASHBOARD
    // ===================
    Route::get('/dashboard', [RecommendationController::class, 'index'])
    ->middleware(['auth','role:user'])
    ->name('dashboard');
    


    // ===================
    // ADMIN DASHBOARD
    // ===================
    Route::get('/admin/dashboard', fn () =>
        Inertia::render('Admin/Dashboard')
    )->middleware('role:admin')->name('admin.dashboard');


    // ===================
    // ROOT REDIRECT
    // ===================
    Route::get('/', function () {
        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        return redirect('/dashboard');
    });


    // ===================
    // LOGOUT
    // ===================
    Route::post('/logout', function () {

        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');

    })->name('logout');

});


// ===================
// ADMIN ROUTES
// ===================
Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::resource('tourist-spot', TouristSpotController::class);

        Route::get('/viral', [ViralController::class, 'index'])->name('admin.viral.index');
        Route::put('/viral/{id}', [ViralController::class, 'update'])->name('admin.viral.update');

});

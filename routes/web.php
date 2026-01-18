<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Auth;

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
    Route::get('/login', fn () => Inertia::render('Auth/Login'))->name('login');
    Route::get('/register', fn () => Inertia::render('Auth/Register'))->name('register');
    Route::post('/login', [AuthController::class, 'login']);
});

// ===================
// AUTH
// ===================
Route::middleware('auth')->group(function () {

    // user
    Route::get('/dashboard', fn () =>
        Inertia::render('User/Dashboard')
    )->middleware('role:user')->name('dashboard');

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

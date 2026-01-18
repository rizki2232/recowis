<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'username'   => 'required|string|unique:users',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|confirmed|min:6',
            'categories' => 'required|array|min:1|max:5',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'username'   => $request->username,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
            ]);

            foreach ($request->categories as $categoryId) {
                DB::table('user_categories')->insert([
                    'user_id' => $user->id,
                    'category_id' => $categoryId,
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Register berhasil',
                'user' => $user
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Register gagal',
                'error' => $e->getMessage()
            ], 500);
        }
    }
 public function login(Request $request)
{
    $request->validate([
        'login' => 'required',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->login)
        ->orWhere('username', $request->login)
        ->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Login gagal'], 401);
    }

    Auth::login($user);

    return response()->json([
        'redirect' => $user->role === 'admin'
            ? '/admin/dashboard'
            : '/dashboard'
    ]);
}

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message'=>'Logout Berhasil'
        ]);
    }
}

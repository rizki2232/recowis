<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function register(request $request)
    {
        $request->validate([
            'first_name' => ['required','string','max:100'] ,
            'last_name' => ['required','string','max:100'],
            'username' => ['required','string','max:50','unique:users'],
            'email' => ['required','email','unique:users'],
            'password' => ['required','confirmed',Password::min(8)],
            'categories'=>['required','array','min:1'],

        ]);
        $user = User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'user',
        ]);

        $user->categories()->sync($request->categories);

        return response()->json([
            'message'=>'Register Berhasil',
            'user'=>$user,
        ],201);

    }
}

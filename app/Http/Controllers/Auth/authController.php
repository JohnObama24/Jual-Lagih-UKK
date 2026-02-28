<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class authController extends Controller
{
    //

    public function ShowLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:seller,buyer',
            'no_hp' => 'required|numeric',
            'alamat' => 'nullable|string'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password has to be hashed on register!
            'role' => $request->role,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('login')->with('success', 'Register Success, Please Login');

    }

    public function Login(Request $requset)
    {
        $credentials = $requset->validate([
            "email" => "required|string|email",
            "password" => "required|string",
        ]);

        if (Auth::attempt($credentials)) {
            $requset->session()->regenerate();
            if (Auth::user()->role == "seller") {
                return redirect('/seller');
            } else {
                return redirect()->route('buyer.home');
            }
        }
        ;

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
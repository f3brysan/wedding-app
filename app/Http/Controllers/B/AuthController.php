<?php

namespace App\Http\Controllers\B;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('back.auth.login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required']
        ]);

        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        // $getUser = User::where('email', $request->email)->first();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('LoginError', 'Login Gagal !');
    }

    public function logout()
    {
        Auth::logout();      

        return redirect('/login');
    }
}

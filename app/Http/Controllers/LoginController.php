<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class LoginController extends Controller
{
    public function tampilLogin() {
        if(Auth::check()) {
            return redirect('dashboard');
        }
        return view('login');
    }

    public function authenticate(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => "The provided credentials do not match our records.",
        ])->onlyInput('email');
    }

    
}

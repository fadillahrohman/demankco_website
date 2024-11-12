<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function tampilLogin()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }
        return view('login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        // Validasi inputan
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Jika email tidak ditemukan
            return back()->withErrors([
                'email' => 'Email atau akun belum terdaftar.',
            ])->onlyInput('email');
        }

        // Jika email terdaftar, cek password
        if (!Hash::check($request->password, $user->password)) {
            // Jika password salah
            return back()->withErrors([
                'password' => 'Password yang Anda masukkan salah.',
            ])->onlyInput('email');
        }

        // Login jika email dan password benar
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('dashboard');
    }
}

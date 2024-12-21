<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;

class LoginController extends Controller
{
    public function login()
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

        // Cek apakah email sudah terverifikasi
        if ($user->email_verified_at === null) {
            // Generate verification token
            $verification_token = mt_rand(100000, 999999);
            $user->verification_token = $verification_token;
            $user->save();

            // Kirim email dengan OTP
            Mail::send('emails.verify-otp', ['token' => $verification_token], function ($message) use ($request) {
                $message->to($request->email)->subject('😎 Verifikasi Email - Kode OTP');
            });

            return redirect()->route('verify.otp', ['email' => $request->email])
                ->withErrors(['email' => 'Email belum diverifikasi. Silakan periksa email Anda untuk verifikasi.']);
        }

        // Login jika email dan password benar
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('dashboard');
    }
}
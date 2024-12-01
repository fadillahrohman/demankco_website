<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin; 
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('dashboard');
        }
        return view('admin.admin_login');
    }

    public function adminAuthenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            // Jika email tidak ditemukan
            return back()->withErrors([
                'email' => 'Email atau akun belum terdaftar.',
            ])->onlyInput('email');
        }

        if (!Hash::check($request->password, $admin->password)) {
            // Jika password salah
            return back()->withErrors([
                'password' => 'Password yang Anda masukkan salah.',
            ])->onlyInput('email');
        }

        // Login jika email dan password benar
        Auth::guard('admin')->login($admin);
        $request->session()->regenerate();

        return redirect()->intended('admin/dashboard');
    }
}


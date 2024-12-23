<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        return view('reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        // Validasi request
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Reset password
        $credentials = $request->only(
            'email',
            'password',
            'password_confirmation',
            'token'
        );

        $status = Password::reset($credentials, function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password),
                'remember_token' => Str::random(60),
            ])->save();
        });

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Password telah direset. Silakan login dengan password baru Anda.');
        }
        
        return back()->withErrors(['email' => __($status)]);
    }
}
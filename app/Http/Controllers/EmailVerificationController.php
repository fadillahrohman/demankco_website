<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    // Menampilkan halaman verifikasi email
    public function show()
    {
        return view('auth.verify-email');
    }

    // Menangani verifikasi email
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/dashboard');
    }

    // Mengirimkan ulang email verifikasi
    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}

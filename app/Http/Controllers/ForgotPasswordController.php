<?php

namespace App\Http\Controllers;

use App\Jobs\SendResetPasswordEmailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{

    public function showLinkRequestForm()
    {
        return view('loginlupa');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['status' => 'Link reset password telah dikirim ke email Anda.']);
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
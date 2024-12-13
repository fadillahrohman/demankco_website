<?php

namespace App\Http\Controllers;

// use App\Jobs\ResendOtpEmailJob;
use App\Jobs\SendOtpEmailJob;
use App\Models\User;
use App\Models\Verifytoken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class RegisterController extends Controller
{
    function register()
    {
        return view('register');
    }

    function submitRegister(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|regex:/^8\d{10,}$/',
            'password' => 'required|regex:/^.{8,}$/|confirmed',
        ], [
            'email.unique' => 'Email telah digunakan atau terdaftar.',
            'phone_number.regex' => 'Nomor Telepon harus diawali dengan angka 8 dan minimal 11 digit.',
            'password.regex' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi Password tidak cocok.',
        ]);


        $name = explode('@', $request->email)[0];

        $user = new User();
        $user->name = $name;
        $user->email = $request->email;
        $user->phone_number = '62' . $request->phone_number;
        $user->password = bcrypt($request->password);
        $user->save();

        // Generate OTP dengan Number
        $token = mt_rand(100000, 999999);

        Verifytoken::create([
            'email' => $request->email,
            'token' => $token,
            'is_activated' => false
        ]);

        try {
            $sendOtpEmail = new SendOtpEmailJob($request->email, $token);
            dispatch($sendOtpEmail);
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Email tidak terkirim, silakan coba lagi.']);
        }

        return redirect()->route('verify.otp', ['email' => $request->email]);
    }

    function showVerifyOtp($email)
    {
        return view('verify-otp', compact('email'));
    }

    function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|size:6'
        ]);



        $verifyToken = Verifytoken::where('email', $request->email)
            ->where('token', $request->otp)
            ->first();

        if ($verifyToken) {

            User::where('email', $request->email)->update(['email_verified_at' => now()]);


            $verifyToken->delete();

            return redirect()->route('login')->with('success', 'Email berhasil diverifikasi!
            Silahkan Login');
        }

        return back()->withErrors(['otp' => 'Kode OTP tidak valid']);
    }

    function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // Generate OTP baru
        $newToken = mt_rand(100000, 999999);
        \Log::info("Generated OTP for resend: " . $newToken);

        Verifytoken::updateOrCreate(
            ['email' => $request->email],
            [
                'token' => $newToken,
                'is_activated' => false,
                'created_at' => now()
            ]
        );


        Mail::send('emails.verify-otp', ['token' => $newToken], function ($message) use ($request) {
            $message->to($request->email)->subject('😎 Verifikasi Email - Kode OTP');
        });


        // $resendOtpEmailJob = new ResendOtpEmailJob($request->email, $newToken);
        // dispatch($resendOtpEmailJob);

        return back()->with('resend_success', 'OTP baru telah dikirim ke email Anda');
    }
}
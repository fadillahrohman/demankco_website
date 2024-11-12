<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    function tampilRegister()
    {
        return view('register');
    }

    function submitRegistrasi(Request $request)
    {

        $request->validate([
            // Cek email apakah sudah terdaftar atau belom
            'email' => 'required|email|unique:users,email',
            // Validasi nomor telepon yang dimulai dengan angka 8 dan minimal 11 digit, dan Cek apakah sudah digunakan atau belom.
            'phone_number' => 'required|regex:/^8\d{10,}$/',
            // Validasi password minimal 8 karakter
            'password' => 'required|regex:/^.{8,}$/'
        ], [
            // Set email bahwa email sudah digunakan / terdaftar
            'email' => 'Email telah digunakan atau terdaftar.',
            // Set pesan kesalahan untuk validasi regex Phone Number (No Ponsel)
            'phone_number.regex' => 'Nomor Telepon harus diawali dengan angka 8 dan minimal 11 digit.',
            // Set pesan kesalahan untuk validasi regex Password 
            'password.regex' => 'Password minimal 8 karakter.',
        ]);

        // Mengambil nama dari email (bagian sebelum @)
        $name = explode('@', $request->email)[0];

        // Menyimpan user / pengguna baru
        $user = new User();
        $user->name = $name;
        $user->email = $request->email;
        $user->phone_number = '62' . $request->phone_number; // Menambahkan '62' sebagai prefix 
        $user->password = bcrypt($request->password);
        $user->save();
        // dd($user);
        // return redirect()->route('login');


        // Mengirim email verifikasi
        $user->sendEmailVerificationNotification();

        // Redirect ke halaman pemberitahuan verifikasi email
        return redirect()->route('verify-email')->with('message', 'Please check your email for verification.');
    }
}
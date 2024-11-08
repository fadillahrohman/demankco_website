<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    function tampilRegister() {
        return view('register');
    }

    function submitRegistrasi(Request $request) {
        // Mengambil nama dari email (bagian sebelum @)
        $name = explode('@', $request->email)[0];
        
        $user = new User();
        $user->name = $name;
        $user->email = $request->email;
        $user->phone_number = $request->no_hp;
        $user->password = bcrypt($request->password);
        $user->save();
        dd($user);
        // return redirect()->route('login');
    } 
}

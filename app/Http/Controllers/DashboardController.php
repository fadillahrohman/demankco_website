<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Kirimkan data user ke view dashboard
        return view('dashboard', compact('user'));
    }
}

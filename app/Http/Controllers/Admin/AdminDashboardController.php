<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 

use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function adminDashboard()
    {
        // Ambil data user yang sedang login
        $user = Auth::guard('admin')->user();
        
        return view('admin.admin_dashboard', compact('user'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mockup;

class MockupController extends Controller
{
    public function mockup()
    {
        return view('mockup');
    }

    // public function saveMockup(Request $request)
    // {
    //     $request->validate([
    //         'state' => 'required|string',
    //     ]);

    //     Mockup::create([
    //         'user_id' => Auth::id(),
    //         'state' => $request->state,
    //     ]);

    //     return response()->json(['message' => 'Progress mockup telah disimpan.']);
    // }

    // public function loadMockup()
    // {
    //     $mockup = Mockup::where('user_id', Auth::id())->latest()->first();

    //     if ($mockup) {
    //         return response()->json(['state' => $mockup->state]);
    //     }

    //     return response()->json(['state' => null]);
    // }
}
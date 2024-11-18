<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MockupController extends Controller
{
    public function mockup()
    {
        return view('mockup');
    }
}

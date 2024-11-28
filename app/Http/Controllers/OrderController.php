<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalog;

class OrderController extends Controller
{


    public function orderTshirt() {
        $catalogs = Catalog::where('type', 'Tshirt')->get();
        
        return view('orders.orderTshirt', compact('catalogs'));
    }

    public function orderCrewneck() {
        $catalogs = Catalog::where('type', 'Crewneck')->get(); 
        
        return view('orders.orderCrewneck', compact('catalogs'));
    }

    public function orderHoodie() {
        $catalogs = Catalog::where('type', 'Hoodie')->get();
        
        return view('orders.orderHoodie', compact('catalogs'));
    }
}

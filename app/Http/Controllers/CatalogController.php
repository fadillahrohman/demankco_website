<?php

namespace App\Http\Controllers;
use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index() {
        $catalogs = Catalog::all();

        session()->flash('alert', 'Gunakan perangkat desktop (PC/Laptop) untuk melihat mockup responsif.');
        return view('catalogs.catalog', compact('catalogs')); 
    }
}
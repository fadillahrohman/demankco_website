<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use PDF;

class AdminLaporanController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::all();
        return view('admin.admin_laporan', [
            'orders' => $orders,
        ]);
    }

    public function cetak_pdf()
    {
    	$orders = Order::all();
 
    	$pdf = PDF::loadview('admin.admin_laporan-pdf',['orders'=>$orders]);
    	return $pdf->download('laporan-penjualan-demankco');
    }

}

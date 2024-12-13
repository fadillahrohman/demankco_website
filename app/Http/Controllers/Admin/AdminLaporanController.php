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
        $orders = Order::where('payment_status', 'paid')->get();
 
    	$pdf = PDF::loadview('admin.admin_laporan-pdf',['orders'=>$orders]);
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
    	return $pdf->download('laporan-penjualan-demankco.pdf');
    }

}

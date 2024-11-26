<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'metode_pembayaran' => 'required|string',
            'total_harga' => 'required|numeric|min:0',
            'alamat' => 'required|string|max:255',
        ]);

        $transaksi = new Transaksi();
        $transaksi->idTransaksi = 'TRX' . time();
        $transaksi->tanggal = $request->tanggal;
        $transaksi->metode_pembayaran = $request->metode_pembayaran;
        $transaksi->total_harga = $request->total_harga;
        $transaksi->alamat = $request->alamat;
        $transaksi->save();

        return redirect()->back()->with('success', 'Pesanan berhasil dikirim!');
    }
}

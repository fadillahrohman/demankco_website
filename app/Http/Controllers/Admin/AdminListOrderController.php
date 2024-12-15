<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class AdminListOrderController extends Controller
{
    public function index(Request $request)
    {
        $order = Order::all();
        return view('admin.admin_list-order', compact('order'));
    }


    public function show(MidtransService $midtransService, Order $order)
    {
        // get last payment
        $payment = $order->payments->last();

        if ($payment == null || $payment->status == 'EXPIRED') {
            $snapToken = $midtransService->createSnapToken($order);

            $order->payments()->create([
                'snap_token' => $snapToken,
                'status' => 'PENDING',
            ]);
        } else {
            $snapToken = $payment->snap_token;
        }

        return view('admin.admin_detail-order', compact('order', 'snapToken'));
    }


    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:processing,shipped,completed,cancelled',
            'receipt' => 'nullable|string|max:255',
        ]);

        $order->status = $validated['status'];

        // Jika status adalah "shipped", tambahkan nomor resi
        if ($validated['status'] === 'shipped' && isset($validated['receipt'])) {
            $order->receipt = $validated['receipt'];
        }

        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Status pesanan berhasil diperbarui.',
        ]);
    }
}

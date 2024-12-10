<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class ListOrderController extends Controller
{

    public function index(Request $request)
    {
        $order_id = $request->get('order_id');

        if (!auth()->check()) {
            // Jika ada order_id, cari pesanan berdasarkan order_id
            $orders = $order_id
                ? Order::where('order_id', $order_id)->get()
                : collect();
        } else {
            $orders = Order::where('user_id', auth()->id())
                ->when($order_id, function ($query, $order_id) {
                    // Jika ada order_id, tambahkan filter berdasarkan order_id
                    $query->where('order_id', $order_id);
                })
                ->get();
        }

        return view('customer.orders.list-order', compact('orders'));
    }


    /**
     * @throws \Exception
     */
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

        return view('customer.orders.detail-order', compact('order', 'snapToken'));
    }
}

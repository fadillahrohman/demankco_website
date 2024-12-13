<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminListOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::all();
        return view('admin.admin_list-order', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:processing,shipped,completed,cancelled',
        ]);

        $order->status = $validated['status'];
        $order->save();

        return response()->json(['success' => true]);
    }
}

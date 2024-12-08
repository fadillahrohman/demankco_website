@extends('layouts.layout')

@section('title', 'Detail Pesanan - DMCO')

@section('content')
<div class="container mx-auto px-4 py-5">
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-[1000px] h-[1000px]">
            <div class="bg-gray-50 shadow-md rounded-lg p-6">
                <h5 class="text-lg font-semibold text-gray-700 mb-4">Data Pesanan</h5>
                <table class="min-w-full table-auto">
                    <tbody>
                        <tr>
                            <td class="font-medium text-gray-500 py-2">ID</td>
                            <td class="font-semibold text-gray-700 py-2">{{ $order->order_id }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium text-gray-500 py-2">Nama Pemesan</td>
                            <td class="font-semibold text-gray-700 py-2">{{ $order->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium text-gray-500 py-2">Total Harga</td>
                            <td class="font-semibold text-gray-700 py-2">Rp {{ number_format($order->total_price, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium text-gray-500 py-2">Status Order</td>
                            <td class="font-semibold text-gray-700 py-2">{{ $order->status }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium text-gray-500 py-2">Status Pembayaran</td>
                            <td class="font-semibold text-gray-700 py-2">{{ $order->payment_status }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium text-gray-500 py-2">Alamat</td>
                            <td class="font-semibold text-gray-700 py-2">{{ $order->address }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium text-gray-500 py-2">Tanggal</td>
                            <td class="font-semibold text-gray-700 py-2">
                                {{ $order->created_at->locale('id')->isoFormat('D MMMM YYYY HH:mm') }}
                            </td>
                        </tr>
                        @if ($order->payment_status == 'unpaid')
                        <tr>
                            <td colspan="2" class="py-4">
                                <button id="pay-button" class="w-full bg-[#3FA3FF] text-white text-[21px] font-semibold py-2 rounded hover:bg-blue-500 transition duration-300">
                                    Bayar Sekarang
                                </button>
                            </td>
                        </tr>
                        @elseif ($order->payment_status == 'paid')
                        <tr>
                            <td colspan="2" class="py-4">
                                <p class="text-green-600 font-semibold">Pembayaran berhasil</p>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <!-- Tombol Kembali -->
                <div class="mt-6">
                    <a href="{{ route('customer.orders.index') }}" class="bg-gray-600 text-white py-2 px-4 rounded hover:bg-gray-500 transition duration-300">
                        <i class="fa-solid fa-backward"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();
        
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                console.log(result);
            },
            onPending: function(result) {
                console.log(result);
            },
            onError: function(result) {
                console.log(result);
            }
        });
    });
</script>
@endsection

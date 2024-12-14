@extends('layouts.layout')

@section('title', 'Detail Pesanan - DMCO')

@section('content')
    <div class="container mx-auto px-4 py-5">
        <div class="flex justify-center items-center min-h-screen relative">
            <div class="w-[1000px] h-[1000px]">
                <div class="bg-gray-50 shadow-md rounded-lg p-6">
                    <h5 class="text-lg font-semibold text-gray-700 mb-4">Data Pesanan</h5>
                    <table class="min-w-full table-auto">
                        <tbody>
                            <tr>
                                <td class="font-medium text-gray-500 py-2">ID Pesanan</td>
                                <td class="font-semibold text-gray-700 py-2">{{ $order->order_id }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-500 py-2">Nama Produk</td>
                                <td class="font-semibold text-gray-700 py-2">{{ $order->product_name }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-500 py-2">Nama Pemesan</td>
                                <td class="font-semibold text-gray-700 py-2">{{ $order->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-500 py-2">Email</td>
                                <td class="font-semibold text-gray-700 py-2">{{ $order->email }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-500 py-2">No. HP</td>
                                <td class="font-semibold text-gray-700 py-2">{{ $order->phone_number }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-500 py-2">Jumlah Pesanan</td>
                                <td class="font-semibold text-gray-700 py-2">{{ $order->number_of_orders }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-500 py-2">Jumlah Ukuran</td>
                                <td class="font-semibold text-gray-700 py-2">
                                    @php
                                        $sizes = json_decode($order->list_size, true);
                                        $filteredSizes = array_filter($sizes, function ($quantity) {
                                            return $quantity > 0;
                                        });
                                    @endphp

                                    @foreach ($filteredSizes as $size => $quantity)
                                        <div>{{ $size }} : {{ $quantity }}</div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-500 py-2">Kurir</td>
                                <td class="font-semibold text-gray-700 py-2">{{ $order->courier }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-500 py-2">Resi Kurir</td>
                                <td class="font-semibold text-gray-700 py-2">{{ $order->receipt }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-500 py-2">Total Harga</td>
                                <td class="font-semibold text-gray-700 py-2">Rp
                                    {{ number_format($order->total_price, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-500 py-2">Status Pesanan</td>
                                <td class="font-semibold text-gray-700 py-2">
                                    @if ($order->payment_status == 'paid' && $order->status == 'processing')
                                        Sedang Diproses <i class="fa-solid fa-boxes-packing"></i>
                                    @elseif ($order->payment_status == 'paid' && $order->status == 'shipped')
                                        Dikirim <i class="fa-solid fa-truck-fast"></i>
                                    @elseif ($order->payment_status == 'paid' && $order->status == 'completed')
                                        <span class="text-green-500">Selesai</span> <i
                                            class="fa-regular fa-square-check text-green-500"></i>
                                    @elseif ($order->payment_status == 'paid' && $order->status == 'cancelled')
                                        <span class="text-red-500">Dibatalkan</span> <i
                                            class="fa-solid fa-circle-xmark text-red-500 "></i>
                                    @elseif ($order->payment_status == 'paid')
                                        Menunggu Konfirmasi Pesanan
                                    @elseif ($order->status == 'pending')
                                        Menunggu Pembayaran
                                    @else
                                        Status Tidak Diketahui..
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-500 py-2">Status Pembayaran</td>
                                <td class="font-semibold text-gray-700 py-2">
                                    @if ($order->payment_status == 'unpaid')
                                        <span class="text-orange-400">Belum Bayar</span>
                                    @elseif ($order->payment_status == 'paid' && $order->status == 'cancelled')
                                        Dana Dikembalikan <i class="fa-solid fa-money-bill-trend-up"></i>
                                    @elseif ($order->payment_status == 'paid')
                                        <span class="text-green-500">Lunas</span> <i
                                            class="fa-regular fa-square-check text-green-500"></i>
                                    @else
                                        Status Tidak Diketahui..
                                    @endif
                                </td>
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
                                        @auth
                                            <!-- Tombol Bayar Sekarang hanya bisa diakses jika sudah login -->
                                            <button id="pay-button"
                                                class="w-full bg-[#3FA3FF] text-white text-[21px] font-semibold py-2 rounded hover:bg-blue-500 transition duration-300">
                                                Bayar Sekarang
                                            </button>
                                        @else
                                            <!-- Jika user belum login, tampilkan pesan -->
                                            <p class="text-red-600 font-semibold text-center">Anda perlu login untuk melakukan
                                                pembayaran.</p>
                                        @endauth
                                    </td>
                                </tr>
                            @elseif ($order->payment_status == 'paid' && $order->status != 'cancelled')
                                <tr>
                                    <td colspan="2" class="py-4">
                                        <p class="text-green-500 font-semibold text-xl">Pembayaran berhasil</p>
                                    </td>
                                </tr>
                            @elseif ($order->payment_status == 'paid' && $order->status == 'cancelled')
                                <tr>
                                    <td colspan="2" class="py-4">
                                        <p class="text-red-500 font-semibold text-xl">Pesanan telah dibatalkan</p>
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                    <div class="mt-6">
                        <a href="{{ route('customer.orders.index') }}"
                            class="bg-gray-600 text-white py-2 px-4 rounded hover:bg-gray-500 transition duration-300">
                            <i class="fa-solid fa-backward"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script>
        const payButton = document.querySelector('#pay-button');
        if (payButton) {
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
        }
    </script>
@endsection

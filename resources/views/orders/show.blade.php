@extends('layouts.layout')

@section('title', 'Detail Pesanan - DMCO')

@section('content')
    <div class="flex justify-center min-h-screen py-8 bg-gray-100">
        <div class="max-w-4xl w-full bg-white shadow-md rounded-lg p-8">
            <h1 class="text-3xl font-bold text-[#3FA3FF] mb-4">Detail Pesanan</h1>
            
            <h2 class="text-lg font-semibold mb-4">Pesanan ID: {{ $order->id }}</h2>
            <p class="text-gray-600 mb-6">Nama Penerima: {{ $order->name }}</p>
            
            <div class="bg-gray-50 p-6 rounded-lg border mb-6">
                <h3 class="text-lg font-bold mb-4">Daftar Barang</h3>
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Nama Produk</th>
                            <th class="border border-gray-300 px-4 py-2">Harga</th>
                            <th class="border border-gray-300 px-4 py-2">Jumlah</th>
                            <th class="border border-gray-300 px-4 py-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->product_name }}</td>
                                <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->quantity }}</td>
                                <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center mb-6">
                <span class="font-semibold">Total Harga</span>
                <span class="font-bold text-lg text-[#3FA3FF]">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>

            {{-- <a href="{{ route('order.index') }}" class="bg-[#3FA3FF] text-white font-semibold px-6 py-2 rounded-md hover:bg-blue-500 transition">
                Kembali ke Daftar Pesanan
            </a> --}}
        </div>
    </div>
@endsection     

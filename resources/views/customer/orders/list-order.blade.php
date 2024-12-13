@extends('layouts.layout')

@section('title', 'Pesanan - DMCO')

@section('content')

    <body class="bg-gray-50 p-6 font-poppins">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-9">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-[#3FA3FF]">Pesanan</h1>
            </div>
            <h1 class="text-xl text-gray-700 mb-6">Cek pesanan kamu disini</h1>

            <!-- Form untuk pengecekan ID pesanan -->
            @if (!auth()->check())
                <div class="bg-white rounded-lg p-6 sm:p-14 border-solid border-2 border-gray-200 mb-10" data-aos="fade-up"
                    data-aos-anchor-placement="top-bottom" data-aos-duration="1000">
                    <form action="{{ url()->current() }}" method="GET"
                        class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <div class="flex-1">
                            <label for="order_id" class="block font-semibold text-xl sm:text-2xl text-gray-700">ID
                                Pesanan</label>
                            <input type="text" id="order_id" name="order_id"
                                class="w-full p-3 border border-gray-300 rounded-md mt-2" placeholder="Masukkan ID Pesanan"
                                required />
                        </div>
                        <div class="self-end">
                            <button type="submit"
                                class="bg-[#3FA3FF] hover:bg-blue-500 text-white p-3 px-7 rounded-xl text-xl">
                                Cek
                            </button>
                        </div>
                    </form>
                </div>
            @endif


            @if (auth()->check())
                <div class="bg-white rounded-lg p-4 border-solid border-2 border-gray-200" data-aos="fade-up"
                    data-aos-anchor-placement="top-bottom" data-aos-duration="1000">
                    @forelse($orders as $order)
                        <div class="flex items-center justify-between pb-4 mb-4 border-gray-300 relative">
                            <div class="flex items-center">
                                <img src="#" class="w-[7rem] h-[7rem] rounded-md object-cover mr-4" />
                                <div>
                                    <h2 class="font-semibold text-xl">{{ $order->product_name }}</h2>
                                    <p class="text-gray-400 text-[16px]">{{ $order->order_id }}</p>
                                    <p class="text-gray-500 text-[18px] font-semibold">Rp
                                        {{ number_format($order->total_price, 2, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <!-- Tombol detail pesanan yang diubah untuk tampilan mobile -->
                                <a href="{{ route('customer.orders.show', $order->id) }}"
                                    class="bg-transparent hover:bg-[#3FA3FF] text-[#3FA3FF]  hover:text-white  font-semibold py-2 px-4 border border-[#3FA3FF] hover:border-transparent rounded text-xl transition-all duration-300 ease-in-out hidden sm:block">
                                    Detail Pesanan
                                </a>
                                <!-- Ikon Detail Pesanan untuk tampilan mobile -->
                                <a href="{{ route('customer.orders.show', $order->id) }}"
                                    class="text-[#3FA3FF] hover:text-blue-500 font-semibold p-3  transition-all duration-300 ease-in-out sm:hidden">
                                    <i class="fa-solid fa-cart-arrow-down text-2xl"></i>
                                </a>
                            </div>
                            <div class="absolute bottom-0 right-0 mb-4 mr-4">
                                @if ($order->payment_status == 'unpaid')
                                    <h2 class="text-gray-500 text-base sm:text-xl">Belum Bayar</h2>
                                @elseif($order->status == 'processing')
                                    <h2 class="text-gray-500 text-base sm:text-xl">Sedang Diproses</h2>
                                @elseif($order->status == 'shipped')
                                    <h2 class="text-gray-500 text-base sm:text-xl">Dikirim</h2>
                                @elseif($order->status == 'completed')
                                    <h2 class="text-gray-500 text-base sm:text-xl">Selesai</h2>
                                @elseif($order->status == 'cancelled')
                                    <h2 class="text-gray-500 text-base sm:text-xl">Dibatalkan</h2>
                                @else
                                    <h2 class="text-gray-500 text-base sm:text-xl">Menunggu Konfirmasi..</h2>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Belum ada pesanan tersedia.</p>
                    @endforelse
                </div>
            @endif

            <!-- Menampilkan Pesanan Tanpa Login dengan ID  Pesanan-->
            @if (request()->has('order_id'))
                @php
                    $order_id = request()->get('order_id');
                    $orders = \App\Models\Order::where('order_id', $order_id)->get(); // Mencari pesanan berdasarkan ID
                @endphp

                @if (!$orders->isEmpty())
                    <div class="bg-white rounded-lg p-4 border-solid border-2 border-gray-200" data-aos="fade-up"
                        data-aos-anchor-placement="top-bottom" data-aos-duration="1000">
                        @foreach ($orders as $order)
                            <div class="flex items-center justify-between pb-4 mb-4 border-gray-300 relative">
                                <div class="flex items-center">
                                    <img src="#" class="w-[7rem] h-[7rem] rounded-md object-cover mr-4" />
                                    <div>
                                        <h2 class="font-semibold text-xl">{{ $order->product_name }}</h2>
                                        <p class="text-gray-400 text-[16px]">{{ $order->order_id }}</p>
                                        <p class="text-gray-500 text-[18px] font-semibold">Rp
                                            {{ number_format($order->total_price, 2, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="flex space-x-4">
                                    <a href="{{ route('customer.orders.show', $order->id) }}"
                                        class="bg-transparent hover:bg-[#3FA3FF] text-[#3FA3FF] hover:text-white font-semibold py-2 px-4 border border-[#3FA3FF] hover:border-transparent rounded text-xl transition-all duration-300 ease-in-out hidden sm:block">
                                        Detail Pesanan
                                    </a>
                                    <!-- Ikon Detail Pesanan untuk tampilan mobile -->
                                    <a href="{{ route('customer.orders.show', $order->id) }}"
                                        class="text-[#3FA3FF] hover:text-blue-500 font-semibold p-3  transition-all duration-300 ease-in-out sm:hidden">
                                        <i class="fa-solid fa-cart-arrow-down text-2xl"></i>
                                    </a>
                                </div>
                                <div class="absolute bottom-0 right-0 mb-4 mr-4">
                                    @if ($order->payment_status == 'unpaid')
                                        <h2 class="text-gray-500 text-base sm:text-xl">Belum Bayar</h2>
                                    @elseif($order->status == 'processing')
                                        <h2 class="text-gray-500 text-base sm:text-xl">Sedang Diproses</h2>
                                    @elseif($order->status == 'shipped')
                                        <h2 class="text-gray-500 text-base sm:text-xl">Dikirim</h2>
                                    @elseif($order->status == 'completed')
                                        <h2 class="text-gray-500 text-base sm:text-xl">Selesai</h2>
                                    @elseif($order->status == 'cancelled')
                                        <h2 class="text-gray-500 text-base sm:text-xl">Dibatalkan</h2>
                                    @else
                                        <h2 class="text-gray-500 text-base sm:text-xl">Menunggu Konfirmasi..</h2>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-lg p-4 border-solid border-2 border-gray-200" data-aos="fade-up"
                        data-aos-anchor-placement="top-bottom" data-aos-duration="1000">
                        <p class="text-center text-gray-500">Pesanan dengan ID "{{ $order_id }}" tidak ditemukan.</p>
                    </div>
                @endif
            @endif
        </div>
    </body>
@endsection

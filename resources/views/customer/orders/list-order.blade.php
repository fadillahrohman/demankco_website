@extends('layouts.layout')

@section('title', 'Pesanan - DMCO')

@section('content')

    <body class="bg-gray-50 p-6 font-poppins">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-9">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-[#3FA3FF]">Pesanan</h1>
            </div>
            <h1 class="text-xl text-gray-700 mb-6">Cek pesanan kamu disini</h1>
            <!-- Form Cek Pesanan -->
            <div class="bg-white rounded-lg p-14 border-solid border-2 border-gray-200 mb-10">
              <form action="" method="GET" class="flex items-center space-x-4">
                  <!-- Input Field -->
                  <div class="flex-1">
                      <label for="order_id" class="block font-semibold text-2xl text-gray-700">ID Pesanan</label>
                      <input type="text" id="order_id" name="order_id"
                          class="w-full p-3 border border-gray-300 rounded-md mt-2" placeholder="Masukkan ID Pesanan"
                          required />
                  </div>
                  <!-- Submit Button -->
                  <div class="self-end">
                      <button type="submit"
                          class="bg-[#3FA3FF] hover:bg-blue-500 text-white p-3 px-7 rounded-xl text-xl">
                          Cek
                      </button>
                  </div>
              </form>
          </div>
          

            <div class="bg-white rounded-lg p-4 border-solid border-2 border-gray-200">
                @forelse($orders as $order)
                    <div class="flex items-center justify-between pb-4 mb-4 border-gray-300 relative">
                        <div class="flex items-center">
                            <img src="#" class="w-[7rem] h-[7rem] rounded-md object-cover mr-4" />
                            <div>
                                {{-- order->name harusnya nama Produk ya han :v, misale T-shirt DMCO konon kah --}}
                                <h2 class="font-semibold text-xl">{{ $order->name }}</h2>
                                <p class="text-gray-400 text-[16px]">{{ $order->order_id }}</p>
                                <p class="text-gray-500 text-[18px] font-semibold">Rp
                                    {{ number_format($order->total_price, 2, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('customer.orders.show', $order->id) }}"
                                class="bg-transparent hover:bg-[#3FA3FF] text-[#3FA3FF] hover:text-white font-semibold py-2 px-4 border border-[#3FA3FF] hover:border-transparent rounded text-xl transition-all duration-300 ease-in-out">
                                Detail Pesanan
                            </a>
                        </div>
                        <div class="absolute bottom-0 right-[0.5rem] mb-4 mr-4">
                            @if ($order->payment_status == 'unpaid')
                                <h2 class="text-gray-500 text-xl">Belum Bayar</h2>
                            @elseif($order->status == 'processing')
                                <h2 class="text-gray-500 text-xl">Sedang Diproses</h2>
                            @elseif($order->status == 'completed')
                                <h2 class="text-gray-500 text-xl">Selesai</h2>
                            @elseif($order->status == 'cancelled')
                                <h2 class="text-gray-500 text-xl">Dibatalkan</h2>
                            @else
                                <h2 class="text-gray-500 text-xl">Menunggu Konfirmasi..</h2>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">Belum ada pesanan tersedia.</p>
                @endforelse
            </div>
        </div>
    @endsection



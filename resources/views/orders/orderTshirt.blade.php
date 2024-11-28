@extends('layouts.layout')

@section('title', 'Pesan - DMCO')

@section('content')
    <div class="flex justify-center min-h-screen py-8 bg-gray-100">
        <div class="max-w-4xl w-full bg-white shadow-md rounded-lg p-8">
            <h1 class="text-3xl font-bold text-[#3FA3FF] mb-2">Pesan</h1>
            <p class="text-gray-600 mb-6">Siapkan informasi pembayaran untuk melanjutkan pesanan</p>
            <div class="bg-gray-50 p-6 rounded-lg border">
                <h2 class="text-lg font-bold mb-4">Ukuran</h2>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">Lengan Pendek</h3>
                        <div class="grid grid-cols-5 gap-4">
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-medium">M</span>
                                <input type="number" value="3" min="0"
                                    class="w-16 h-10 border rounded-md text-center focus:outline-none focus:ring focus:ring-blue-300" />
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-medium">L</span>
                                <input type="number" min="0"
                                    class="w-16 h-10 border rounded-md text-center focus:outline-none focus:ring focus:ring-blue-300" />
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-medium">XL</span>
                                <input type="number" min="0"
                                    class="w-16 h-10 border rounded-md text-center focus:outline-none focus:ring focus:ring-blue-300" />
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-medium">XXL</span>
                                <input type="number" min="0"
                                    class="w-16 h-10 border rounded-md text-center focus:outline-none focus:ring focus:ring-blue-300" />
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">Lengan Panjang</h3>
                        <div class="grid grid-cols-5 gap-4">
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-medium">M</span>
                                <input type="number" value="1" min="0"
                                    class="w-16 h-10 border rounded-md text-center focus:outline-none focus:ring focus:ring-blue-300" />
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-medium">L</span>
                                <input type="number" min="0"
                                    class="w-16 h-10 border rounded-md text-center focus:outline-none focus:ring focus:ring-blue-300" />
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-medium">XL</span>
                                <input type="number" min="0"
                                    class="w-16 h-10 border rounded-md text-center focus:outline-none focus:ring focus:ring-blue-300" />
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-medium">XXL</span>
                                <input type="number" min="0"
                                    class="w-16 h-10 border rounded-md text-center focus:outline-none focus:ring focus:ring-blue-300" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right text-gray-500 mt-4">
                    <span>Total: </span>
                    <span class="font-bold">4</span>
                </div>
                {{-- <div class="text-left text-gray-500 mt-4">
        <p class="text-[10px] text-red-500"><i>Jika pesan Crewneck atau Hoodie kosongkan ukuran lengan panjang</i></p>
      </div> --}}
            </div>
            <div class="mt-6">
                <div class="mb-4">
                    <label for="name" class="block font-medium">Nama</label>
                    <input type="text" id="name" placeholder="Masukan nama penerima"
                        class="w-full border rounded-md h-10 px-3 mt-2 focus:outline-none focus:ring focus:ring-blue-300" />
                </div>
                <div class="mb-4">
                    <label for="address" class="block font-medium">Alamat</label>
                    <textarea id="address" placeholder="Masukan alamat penerima"
                        class="w-full border rounded-md h-20 px-3 py-2 mt-2 focus:outline-none focus:ring focus:ring-blue-300"></textarea>
                </div>
                <hr>
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-medium text-gray-700">Harga Produk</span>
                        <span class="font-bold text-gray-900">Rp
                            {{ number_format($catalogs->first()->price, 0, ',', '.') }}</span>
                    </div>
                    <hr>
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-medium text-gray-700">Harga Jasa</span>
                        <span class="font-bold text-gray-900">Rp 50.000</span>
                    </div>
                    <hr>
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-700">Total Harga</span>
                        <span class="font-bold text-[#3FA3FF]">Rp 200.000</span>
                    </div>
                </div>
                <hr>
                <div class="flex justify-end mt-5">
                    <a href="#"
                        class="bg-[#3FA3FF] text-white font-semibold px-6 py-2 rounded-md hover:bg-blue-500 transition">
                        Bayar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

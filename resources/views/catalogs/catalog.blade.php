@extends('layouts.layout')

@section('title', 'Katalog - DMCO')

@section('content')
    <style>
        /* Menyembunyikan alert pada tampilan desktop dan tablet */
        @media (min-width: 768px) {
            .alert-mobile {
                display: none;
            }
        }

        /* Menampilkan alert hanya pada tampilan mobile */
        @media (max-width: 767px) {
            .alert-mobile {
                display: block;
            }
        }
    </style>
    @if (session('alert'))
        <div class="alert-mobile bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md"
            role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-blue-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                    </svg>
                </div>
                <div>
                    {{ session('alert') }}
                </div>
            </div>
        </div>
    @endif
    <div class="flex justify-center mb-2 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-3xl font-semibold mb-4 text-[#3FA3FF]">Katalog</h1>
            <p class="text-gray-600 mb-8">Cek katalog terbaru kami</p>

            @if (count($catalogs) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" data-aos="fade-up"
                    data-aos-anchor-placement="top-bottom" data-aos-duration="1000">
                    @foreach ($catalogs as $catalog)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden w-80 h-90">
                            @if (isset($catalog['image']) && $catalog['image'])
                                <img src="{{ asset('uploads/catalogs/' . $catalog['image']) }}" alt="{{ $catalog['name'] }}"
                                    class="w-full h-56 object-cover">
                            @else
                                <img src="{{ asset('images/default-placeholder.png') }}" alt="No IMAGE"
                                    class="w-full h-56 object-cover">
                            @endif
                            <div class="p-4">
                                <h2 class="text-lg mb-2 font-semibold">{{ $catalog['name'] }}</h2>

                                <!-- Menampilkan informasi harga -->
                                <p class="text-gray-700 text-sm mb-1"><span class="font-bold text-lg">Rp
                                        {{ number_format($catalog['price'], 0, ',', '.') }}</span></p>

                                <!-- Menampilkan informasi stok -->
                                <p class="text-gray-700 text-[16px] mb-3">Stok: <span
                                        class="font-bold">{{ $catalog['stock'] }}</span></p>

                                @if ($catalog['stock'] == 0)
                                    <!-- Tombol tidak bisa diklik jika stok habis -->
                                    <button class="bg-gray-500 text-white px-4 py-2 rounded-md cursor-not-allowed"
                                        disabled>Stok habis</button>
                                @else
                                    @if ($catalog['type'] === 'Tshirt')
                                        <a href="{{ route('mockT-shirt') }}"
                                            class="bg-[#3FA3FF] text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                            Mockup T-shirt
                                        </a>
                                    @elseif ($catalog['type'] === 'Crewneck')
                                        <a href="{{ route('mockCrewneck') }}"
                                            class="bg-[#3FA3FF] text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                            Mockup Crewneck
                                        </a>
                                    @elseif ($catalog['type'] === 'Hoodie')
                                        <a href="{{ route('mockHoodie') }}"
                                            class="bg-[#3FA3FF] text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                            Mockup Hoodie
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500">Tidak ada katalog yang tersedia.</p>
            @endif
        </div>
    </div>
    <!-- Section: Product -->
    <div class="container mx-auto px-4 lg:px-8 xl:px-16">
        <!-- Product 1 -->
        <div class="items-center w-full grid-cols-2 mx-auto overflow-x-hidden lg:grid md:py-14 lg:py-24 xl:py-14 lg:mt-3 xl:mt-5"
            data-aos="fade-right" data-aos-duration="800">
            <div class="pr-2 md:mb-14 py-14 md:py-0 px-6 lg:px-8 xl:px-16">
                <h1 class="text-3xl font-semibold text-blue-900 xl:text-5xl lg:text-3xl"><span class="block w-full">Desain
                        Unik
                        dan Personalisasi<i class="fa-solid fa-pen-nib"></i></span></h1>
                <p class="py-4 text-lg text-gray-500 2xl:py-8 md:py-6 2xl:pr-5">
                    Desain yang sepenuhnya dapat disesuaikan dengan keinginan pelanggan. Pengguna dapat memilih warna,
                    gambar, teks, atau bahkan membuat desain mereka sendiri.
                </p>
            </div>

            <div class="pb-10 overflow-hidden md:p-10 lg:p-0 sm:pb-0">
                <img id="heroImg1"
                    class="transition-all duration-300 ease-in-out hover:scale-105 lg:w-full sm:mx-auto sm:w-4/6 sm:pb-12 lg:pb-0"
                    src="/images/dmco_product.png" alt="DMCO PRODUCT" width="500" height="488" />
            </div>
        </div>

        <!-- Product 2 -->
        <div class="items-center w-full grid-cols-2 mx-auto overflow-x-hidden lg:grid md:py-14 lg:py-24 xl:py-14 lg:mt-3 xl:mt-5"
            data-aos="fade-left" data-aos-duration="800">
            <div class="pb-10 overflow-hidden md:p-10 lg:p-0 sm:pb-0">
                <img id="heroImg2"
                    class="transition-all duration-300 ease-in-out hover:scale-105 lg:w-full sm:mx-auto sm:w-4/6 sm:pb-12 lg:pb-0"
                    src="/images/dmco_product2.png" alt="DMCO PRODUCT" width="500" height="488" />
            </div>
            <div class="pr-2 md:mb-14 py-14 md:py-0 px-6 lg:px-8 xl:px-16">
                <h1 class="text-3xl font-semibold text-blue-900 xl:text-5xl lg:text-3xl"><span class="block w-full">Bahan
                        Berkualitas<i class="fa-solid fa-crown"></i></span></h1>
                <p class="py-4 text-lg text-gray-500 2xl:py-8 md:py-6 2xl:pr-5">
                    Menggunakan bahan premium yang nyaman, dan berkualitas tinggi seperti katun 100% yang nyaman digunakan
                    untuk berbagai aktivitas.
                </p>
            </div>
        </div>

        <!-- Product 3 -->
        <div class="items-center w-full grid-cols-2 mx-auto overflow-x-hidden lg:grid md:py-14 lg:py-24 xl:py-14 lg:mt-3 xl:mt-5"
            data-aos="fade-right" data-aos-duration="800">
            <div class="pr-2 md:mb-14 py-14 md:py-0 px-6 lg:px-8 xl:px-16">
                <h1 class="text-3xl font-semibold text-blue-900 xl:text-5xl lg:text-3xl"><span class="block w-full">Garansi
                        Kepuasan<i class="fa-solid fa-hand-holding-heart"></i></span></h1>
                <p class="py-4 text-lg text-gray-500 2xl:py-8 md:py-6 2xl:pr-5">
                    Menjamin kualitas produk dan memberikan garansi jika produk tidak sesuai dengan harapan pelanggan.
                </p>
            </div>

            <div class="pb-10 overflow-hidden md:p-10 lg:p-0 sm:pb-0">
                <img id="heroImg3"
                    class="transition-all duration-300 ease-in-out hover:scale-105 lg:w-full sm:mx-auto sm:w-4/6 sm:pb-12 lg:pb-0"
                    src="/images/dmco_product3.png" alt="DMCO PRODUCT" width="500" height="488" />
            </div>
        </div>
    </div>
@endsection

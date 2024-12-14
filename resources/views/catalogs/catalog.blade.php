@extends('layouts.layout')

@section('title', 'Katalog - DMCO')

@section('content')
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
                                {{-- <p class="text-sm text-gray-500 mb-4">{{ number_format($catalog['price'], 0, ',', '.') }} IDR</p> --}}
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
            <h1 class="text-3xl font-semibold text-blue-900 xl:text-5xl lg:text-3xl"><span class="block w-full">Desain Unik
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

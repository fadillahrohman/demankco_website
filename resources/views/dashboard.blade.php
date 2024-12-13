@extends('layouts.layout')

@section('title', 'Home - DMCO')

@section('content')
    <div class="relative font-poppins">
        <!-- Main Content -->
        <main class="relative min-h-screen flex flex-col justify-center overflow-hidden">
            <div class="w-full max-w-6xl mx-auto px-4 md:px-6 py-12 md:py-24">
                <div class="text-center space-y-6" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                    data-aos-duration="1000">
                    <!-- Sliding Text animation -->
                    <div
                        class="font-extrabold text-2xl sm:text-3xl md:text-4xl [text-wrap:balance] bg-clip-text text-[#3FA3FF] bg-gradient-to-r from-slate-200/60 to-50% to-slate-200">
                        Dari Karya Anda Menjadi Produk
                        <span
                            class="text-slate-800 inline-flex flex-col h-[calc(theme(fontSize.2xl)*theme(lineHeight.tight))] sm:h-[calc(theme(fontSize.3xl)*theme(lineHeight.tight))] md:h-[calc(theme(fontSize.4xl)*theme(lineHeight.tight))] overflow-hidden">
                            <ul class="block animate-text-slide text-left leading-tight [&_li]:block">
                                <li>Nyata!</li>
                                <li>Unik</li>
                                <li>Eklusif</li>
                                <li>Kreatif</li>
                                <li>Luar Biasa</li>
                                <li aria-hidden="true">Nyata!</li>
                            </ul>
                        </span>
                    </div>
                    <!-- End: Sliding Text animation -->
                    <p class="text-gray-600 max-w-3xl mx-auto text-lg mt-6">
                        Transformasikan ide kreatif Anda menjadi produk nyata dengan layanan custom sablon kami!
                        dengan hasil berkualitas tinggi dan detail presisi.
                    </p>
                </div>

                <!-- Featured Image -->
                <div class="max-w-4xl mx-auto overflow-hidden rounded-lg shadow-lg mt-12 sm:mt-16" data-aos="fade-up"
                    data-aos-duration="1000">
                    <img src="/images/dmco.png" alt="Custom Product" class="w-full h-auto object-fill" />
                </div>
            </div>

            <!-- Section: DTF dan Sublim -->
            <div class="relative font-poppins py-12 mt-36" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                data-aos-duration="1000">
                <div class="flex flex-col md:flex-row items-center gap-8 max-w-6xl mx-auto px-4 md:px-6">
                    <div class="w-full md:w-1/2">
                        <img src="/images/dtf_printer.png" alt="Mesin DTF dan Sublim" class="w-full h-auto object-cover ">
                    </div>
                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h2 class="text-3xl md:text-4xl font-bold text-[#3FA3FF]">
                            DTF (Direct Transfer Film)
                        </h2>
                        <p class="text-gray-700 text-base md:text-lg leading-relaxed">
                            DTF kami gunakan sebagai bahan terbaik untuk sablon kami.
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

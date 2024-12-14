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
                        Transformasikan ide kreatif Kamu menjadi produk nyata dengan layanan custom sablon kami!
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

    {{-- FAQ --}}
    <div class="p-5 bg-light-blue">
        <div class="flex justify-center items-start my-2">
            <div class="w-full sm:w-10/12 md:w-1/2 my-1">
                <h2 class="text-xl font-semibold text-vnet-blue mb-2">FAQ DEMANKCO <i
                        class="fa-regular fa-circle-question"></i></h2>
                <ul class="flex flex-col">
                    <li class="bg-white my-2 shadow-lg" x-data="accordion(1)">
                        <h2 @click="handleClick()"
                            class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                            <span>Apa itu DEMANKCO?</span>
                            <svg :class="handleRotate()"
                                class="fill-current text-[#3FA3FF] h-6 w-6 transform transition-transform duration-500"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                </path>
                            </svg>
                        </h2>
                        <div x-ref="tab" :style="handleToggle()"
                            class="border-l-2 border-[#3FA3FF] overflow-hidden max-h-0 duration-500 transition-all">
                            <p class="p-3 text-gray-900">
                                DEMANKCO adalah penyedia jasa custom sablon yang memungkinkan pelanggan untuk membuat desain
                                pakaian sesuai keinginan mereka. Kami juga menyediakan fitur mockup interaktif untuk melihat
                                hasil visual desain Kamu sebelum produksi.
                            </p>
                        </div>
                    </li>
                    <li class="bg-white my-2 shadow-lg" x-data="accordion(2)">
                        <h2 @click="handleClick()"
                            class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                            <span>Apa yang dimaksud dengan fitur mockup?</span>
                            <svg :class="handleRotate()"
                                class="fill-current text-[#3FA3FF] h-6 w-6 transform transition-transform duration-500"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                </path>
                            </svg>
                        </h2>
                        <div class="border-l-2 border-[#3FA3FF] overflow-hidden max-h-0 duration-500 transition-all"
                            x-ref="tab" :style="handleToggle()">
                            <p class="p-3 text-gray-900">
                                Fitur mockup memungkinkan Anda untuk mengunggah desain dan melihat tampilan akhir desain
                                tersebut pada produk seperti tshirt, hoodie, atau merchandise lainnya secara virtual sebelum
                                masuk ke proses produksi.
                            </p>
                        </div>
                    </li>
                    <li class="bg-white my-2 shadow-lg" x-data="accordion(3)">
                        <h2 @click="handleClick()"
                            class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                            <span>Apa saja jenis produk yang bisa saya custom di DEMANKCO?</span>
                            <svg :class="handleRotate()"
                                class="fill-current text-[#3FA3FF] h-6 w-6 transform transition-transform duration-500"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                </path>
                            </svg>
                        </h2>
                        <div class="border-l-2 border-[#3FA3FF] overflow-hidden max-h-0 duration-500 transition-all"
                            x-ref="tab" :style="handleToggle()">
                            <p class="p-3 text-gray-900">
                                Saat ini kami terdapat tiga produk: T-shirt, Hoodie dan Crewneck
                            </p>
                        </div>
                    </li>
                    <li class="bg-white my-2 shadow-lg" x-data="accordion(4)">
                        <h2 @click="handleClick()"
                            class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                            <span>Apakah DEMANKCO memberikan garansi?</span>
                            <svg :class="handleRotate()"
                                class="fill-current text-[#3FA3FF] h-6 w-6 transform transition-transform duration-500"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                </path>
                            </svg>
                        </h2>
                        <div class="border-l-2 border-[#3FA3FF] overflow-hidden max-h-0 duration-500 transition-all"
                            x-ref="tab" :style="handleToggle()">
                            <p class="p-3 text-gray-900">
                                Ya, kami memberikan garansi untuk produk yang cacat produksi atau tidak sesuai pesanan. Kamu
                                bisa menghubungi tim kami dalam waktu 7 hari setelah menerima produk untuk klaim garansi.
                            </p>
                        </div>
                    </li>
                    <li class="bg-white my-2 shadow-lg" x-data="accordion(5)">
                        <h2 @click="handleClick()"
                            class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                            <span>Bahan apa yang digunakan untuk produk custom?</span>
                            <svg :class="handleRotate()"
                                class="fill-current text-[#3FA3FF] h-6 w-6 transform transition-transform duration-500"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                </path>
                            </svg>
                        </h2>
                        <div class="border-l-2 border-[#3FA3FF] overflow-hidden max-h-0 duration-500 transition-all"
                            x-ref="tab" :style="handleToggle()">
                            <p class="p-3 text-gray-900">
                                Kami menggunakan bahan berkualitas tinggi seperti:
                                <br>
                                - Cotton Combed 24s/30s untuk T-shirt
                                <br>
                                - Fleece Cotton untuk Hoodie dan Crewneck
                            </p>
                        </div>
                    </li>
                    <li class="bg-white my-2 shadow-lg" x-data="accordion(6)">
                        <h2 @click="handleClick()"
                            class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                            <span>Berapa lama waktu produksi?</span>
                            <svg :class="handleRotate()"
                                class="fill-current text-[#3FA3FF] h-6 w-6 transform transition-transform duration-500"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                </path>
                            </svg>
                        </h2>
                        <div class="border-l-2 border-[#3FA3FF] overflow-hidden max-h-0 duration-500 transition-all"
                            x-ref="tab" :style="handleToggle()">
                            <p class="p-3 text-gray-900">
                                Waktu produksi biasanya memakan waktu 2-7 hari kerja, tergantung pada jumlah pesanan dan
                                kompleksitas desain.
                            </p>
                        </div>
                    </li>

                    <li class="bg-white my-2 shadow-lg" x-data="accordion(7)">
                        <h2 @click="handleClick()"
                            class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer">
                            <span>Bagaimana cara pembayaran?</span>
                            <svg :class="handleRotate()"
                                class="fill-current text-[#3FA3FF] h-6 w-6 transform transition-transform duration-500"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                </path>
                            </svg>
                        </h2>
                        <div class="border-l-2 border-[#3FA3FF] overflow-hidden max-h-0 duration-500 transition-all"
                            x-ref="tab" :style="handleToggle()">
                            <p class="p-3 text-gray-900">
                                Kami menerima pembayaran melalui transfer bank dan e-wallet. Semua transaksi dilakukan
                                melalui
                                platform pembayaran yang aman.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- ALPINE JS --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('accordion', {
                tab: 0
            });

            Alpine.data('accordion', (idx) => ({
                init() {
                    this.idx = idx;
                },
                idx: -1,
                handleClick() {
                    this.$store.accordion.tab = this.$store.accordion.tab === this.idx ? 0 : this.idx;
                },
                handleRotate() {
                    return this.$store.accordion.tab === this.idx ? 'rotate-180' : '';
                },
                handleToggle() {
                    return this.$store.accordion.tab === this.idx ?
                        `max-height: ${this.$refs.tab.scrollHeight}px` : '';
                }
            }));
        })
    </script>
@endsection

@extends('layouts.layout')

@section('title', 'Daftar Akun - DMCO')

@section('content')
    <div class="bg-gray-100 min-h-screen flex items-center justify-center font-poppins px-4 md:px-0">
        <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-lg shadow-lg overflow-hidden" data-aos="fade-up" data-aos-duration="800">
            <div class="w-full md:w-1/2 p-8 md:p-12">
                <h2 class="text-3xl md:text-4xl font-normal text-blue-400 text-center mb-8 md:mb-12">
                    Daftar
                </h2>
                <form class="space-y-4 md:space-y-6" action="{{ route('register-submit') }}" method="POST">
                    @csrf
                    {{-- FORM EMAIL --}}
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <span class="text-gray-500"><i class="fa-solid fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" required placeholder="Masukkan email"
                            class="w-full px-4 py-3 pl-16 rounded-full border border-gray-200 focus:outline-none focus:border-blue-400"
                            value="{{ old('email') }}" />
                    </div>
                    <div>
                        @error('email')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- FORM PHONE NUMBER (No HP / Ponsel) --}}
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <span class="text-gray-500">+62</span>
                        </div>
                        <input type="tel" name="phone_number" required placeholder="Masukkan nomor telepon"
                            class="w-full px-4 py-3 pl-16 rounded-full border border-gray-200 focus:outline-none focus:border-blue-400"
                            value="{{ old('phone_number') }}" maxlength="11" />
                    </div>
                    <div>
                        @error('phone_number')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- FORM PASSWORD --}}
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <span class="text-gray-500"><i class="fa-solid fa-key"></i></span>
                        </div>
                        <input type="password" name="password" required placeholder="Masukkan password"
                            class="w-full px-4 py-3 pl-16 rounded-full border border-gray-200 focus:outline-none focus:border-blue-400" />
                    </div>
                    {{-- FORM CONFIRM PASSWORD --}}
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <span class="text-gray-500"><i class="fa-solid fa-lock"></i></span>
                        </div>
                        <input type="password" name="password_confirmation" required placeholder="Konfirmasi password"
                            class="w-full px-4 py-3 pl-16 rounded-full border border-gray-200 focus:outline-none focus:border-blue-400" />
                    </div>
                    <div>
                        @error('password')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-400 text-white py-3 rounded-full hover:bg-blue-500 transition duration-300">
                        Daftar
                    </button>

                    <div class="text-center text-gray-400 text-sm">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300">Login</a>
                    </div>
                </form>
            </div>
            <div class="hidden md:flex w-full md:w-1/2 items-center justify-center">
                <img src="/images/dmco.png" alt="DMCO" class="object-cover w-full h-full" />
            </div>
        </div>
    </div>
@endsection

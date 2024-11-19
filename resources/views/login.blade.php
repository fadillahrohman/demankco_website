@extends('layouts.layout')

@section('title', 'Login')

@section('content')
    @if (session('success'))
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                    </svg></div>
                <div>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
    <div class="bg-gray-100 h-screen flex items-center justify-center font-poppins">
        <div class="flex w-full max-w-4xl bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="w-1/2 p-12">
                <h2 class="text-4xl font-normal text-blue-400 text-center mb-12">
                    Login
                </h2>
                <form class="space-y-6" action="{{ route('authenticate') }}" method="POST">
                    @csrf
                    {{-- FORM EMAIL --}}
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <span class="text-gray-500"><i class="fa-solid fa-envelope"></i></span>
                        </div>
                        <div>
                            <input type="email" name="email" required placeholder="Masukkan email"
                                class="w-full px-4 py-3 pl-16 rounded-full border border-gray-200 focus:outline-none focus:border-blue-400"
                                value="{{ old('email') }}" />
                        </div>
                    </div>
                    {{-- NOTIFIKASI VALIDASI (kesalahan) pegisian Password --}}
                    <div>
                        @error('email')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- FORM PASSWORD --}}
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <span class="text-gray-500"><i class="fa-solid fa-key"></i></span>
                        </div>
                        <div>
                            <input type="password" name="password" required placeholder="Masukkan password"
                                class="w-full px-4 py-3 pl-16 rounded-full border border-gray-200 focus:outline-none focus:border-blue-400" />
                        </div>
                    </div>
                    {{-- NOTIFIKASI VALIDASI (kesalahan) pegisian Password --}}
                    <div>
                        @error('password')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-400 text-white py-3 rounded-full hover:bg-blue-500 transition duration-300">
                        Login
                    </button>

                    <div class="text-center text-gray-400 text-sm">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-gray-400 hover:text-blue-400">Daftar</a>
                    </div>
                </form>
            </div>
            <div class="w-1/2 flex items-center justify-center">
                <img src="/images/dmco.png" alt="DMCO" class="object-cover w-full h-full" />
            </div>
        </div>
    </div>
@endsection

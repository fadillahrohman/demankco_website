@extends('layouts.layout')

@section('title', 'Login')

@section('content')
<div class="bg-gray-100 h-screen flex items-center justify-center font-poppins">
    <div class="flex w-full max-w-4xl bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="w-1/2 p-12">
            <h2 class="text-4xl font-normal text-blue-400 text-center mb-12">
                Login
            </h2>
            <form class="space-y-6" action="{{ route('authenticate') }}" method="post">
                @csrf
                <div>
                    <input type="email" name="email" required placeholder="Masukkan email"
                        class="w-full px-4 py-3 rounded-full border border-gray-200 focus:outline-none focus:border-blue-400" />
                </div>
                <div>
                    <input type="password" name="password" required placeholder="Masukkan password"
                        class="w-full px-4 py-3 rounded-full border border-gray-200 focus:outline-none focus:border-blue-400" />
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
        <div class="w-1/2">
            <img src="/images/dmco.png" alt="DMCO" />
        </div>
    </div>
</div>
@endsection


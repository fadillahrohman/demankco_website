@extends('layouts.layout')

@section('title', 'Pesan - DMCO')

@section('content')
<div class="flex justify-center items-center min-h-screen py-8 bg-gray-100">
    <div class="max-w-2xl w-full bg-white shadow-md rounded-lg p-8 text-center">
        <h1 class="text-3xl font-bold text-[#3FA3FF] mb-4">Pesanan Terkirim</h1>
        <dotlottie-player 
            src="https://lottie.host/80b4cc1d-f489-4b82-8e7e-bbced5847fd6/b7MALJY0sQ.lottie" 
            background="transparent" 
            speed="1" 
            style="width: 300px; height: 300px; margin: 0 auto;" 
            direction="1" 
            playMode="normal" 
            autoplay>
        </dotlottie-player>
        <p class="text-lg text-gray-600 mt-4">
            Dalam <span id="countdown" class="text-[#3FA3FF] font-bold">10</span> detik, Kamu akan diarahkan ke halaman daftar pesanan.
        </p>
        <hr>
        <p class="text-lg text-green-500 font-medium mt-4">
            Selesaikan pembayaran Kamu untuk memproses pesanan.
        </p>
        <p class="text-lg text-gray-500 mt-2">
            Created by 3R &copy; 2024 <span class="text-lg text-gray-800">X</span> DMCO
        </p>
    </div>
</div>

<script>
    let countdownElement = document.getElementById("countdown");
    let countdownValue = 10;

    // Fungsi untuk mengurangi countdown setiap detik
    let countdownInterval = setInterval(() => {
        countdownValue--;
        countdownElement.textContent = countdownValue;

        // Setelah hitungan mundur selesai, redirect ke halaman pesanan
        if (countdownValue === 0) {
            clearInterval(countdownInterval);
            window.location.href = "/list/orders/";
        }
    }, 1000);
</script>
@endsection

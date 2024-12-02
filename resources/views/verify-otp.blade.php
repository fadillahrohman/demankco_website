<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - DMCO</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <script>
        // Function untuk menghitung waktu mundur
        function startCountdown(duration, buttonId) {
            const button = document.getElementById(buttonId);
            button.disabled = true;
            button.classList.add('opacity-50', 'cursor-not-allowed');
            let remainingTime = duration;

            const timer = setInterval(() => {
                if (remainingTime <= 0) {
                    clearInterval(timer);
                    button.disabled = false;
                    button.classList.remove('opacity-50', 'cursor-not-allowed');
                    button.innerText = "Kirim ulang Kode OTP";
                } else {
                    button.innerText = `Kirim ulang Kode OTP (${remainingTime}s)`;
                }
                remainingTime--;
            }, 1000);
        }
        // Tombol kirim Email ulang (aktif)
        window.onload = () => {
            startCountdown(60, "resendButton"); // 1 menit = 60 detik
        };
    </script>
</head>

<body class="font-poppins bg-gray-100">
    @if (session('resend_success'))
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                    </svg></div>
                <div>
                    {{ session('resend_success') }}
                </div>
            </div>
        </div>
    @endif
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="flex w-full max-w-4xl bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="w-1/2 p-12 flex flex-col">
                <h2 class="text-4xl font-normal text-blue-400 text-center mb-6">
                    Verifikasi Email
                </h2>
                <form class="flex-grow flex flex-col items-center space-y-6" action="{{ route('verify.process') }}"
                    method="POST">
                    @csrf
                    <div class="flex justify-center w-full">
                        <dotlottie-player
                            src="https://lottie.host/991fe643-bdb2-4df5-9261-5f95e5ad34ed/iQdOE3jgtb.lottie"
                            background="transparent" speed="1" style="width: 200px; height: 200px" loop
                            autoplay></dotlottie-player>
                    </div>
                    <p class="text-center text-gray-600 mb-4">
                        Silakan verifikasi email dengan Kode OTP <br>
                        Cek Email Kamu
                    </p>

                    <div class="w-full">
                        <div class="relative mb-4">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <span class="text-gray-500"><i class="fa-solid fa-paper-plane"></i></span>
                            </div>
                            <input type="hidden" name="email" value="{{ $email }}">
                            <input type="text" name="otp" required placeholder="Masukkan Kode OTP" maxlength="6"
                                class="w-full px-4 py-3 pl-16 rounded-full border border-gray-200 focus:outline-none focus:border-blue-400" />
                        </div>
                        @error('otp')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                        <button type="submit"
                            class="w-full bg-blue-400 text-white py-3 rounded-full hover:bg-blue-500 transition duration-300 mb-4">
                            <i class="fa-solid fa-envelope-circle-check"></i>
                            Verifikasi
                        </button>
                    </div>
                </form>
                <form method="POST" action="{{ route('resend.otp') }}" class="text-center">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <button type="submit" id="resendButton"
                        class="text-blue-500 hover:text-blue-600 transition duration-300">
                        Kirim ulang Kode OTP
                    </button>
                </form>
            </div>
            <div class="w-1/2">
                <img src="/images/dmco.png" alt="DMCO" class="w-full h-full object-cover" />
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
</body>

</html>

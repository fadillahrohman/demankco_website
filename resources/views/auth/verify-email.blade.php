<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Berhasil Daftar</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">    
</head>
<body class="font-poppins">
    <div class="bg-gray-100 h-screen flex items-center justify-center">
        <div class="flex w-full max-w-4xl bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="w-1/2 p-12">
                <h2 class="text-4xl font-normal text-blue-400 text-center mb-2">
                    Berhasil Daftar!
                </h2>
                <div class="flex flex-col items-center space-y-6">
                    <div class="flex justify-center w-full">
                        <dotlottie-player 
                            src="https://lottie.host/403d08a5-4988-4525-8035-e4f5f5d87316/BuSGiTmVb3.json" 
                            background="transparent" 
                            speed="1" 
                            style="width: 200px; height: 200px" 
                            direction="1" 
                            playMode="normal" 
                            autoplay
                        ></dotlottie-player>
                    </div>
                    <p class="text-center text-gray-600">
                        Silakan verifikasi email kamu untuk mendapatkan akses ke halaman login.
                    </p>
                    <p class="text-center text-gray-600">Cek email kamu untuk instruksi lebih lanjut.</p>
                    <a href="https://mail.google.com/mail/" target="_blank" class="w-full">
                        <button class="w-full bg-blue-400 text-white py-3 rounded-full hover:bg-blue-500 transition duration-300">
                            <i class="fa-regular fa-envelope mr-2"></i>
                            Cek Gmail
                        </button>
                    </a>
                </div>
            </div>
            <div class="w-1/2">
                <img src="/images/dmco.png" alt="DMCO" class="w-full h-full object-cover"/>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
</body>
</html>
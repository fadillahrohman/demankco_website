<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    @vite('resources/css/app.css')

    {{-- GOOGLE FONTS --}}
    {{-- POPPINS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-white font-poppins">
    <!-- Navbar -->
    @unless(Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register')
        @include('navbar')
    @endunless

    <!-- Content -->
    <div>
        @yield('content')
    </div>

    <!-- Footer -->
    {{-- @include('footer') --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/3.6.2/fabric.min.js"></script>
    <!-- Tes Load Fabric.js -->
    <!-- Scripts -->
    @stack('fabric_scripts')
</body>
</html>

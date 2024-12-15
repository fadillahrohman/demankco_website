<!-- Navbar -->
<nav class="py-6">
    <div class="container mx-auto px-4">
        <div class="items-center justify-between">
            <h1 class="text-4xl font-bold tracking-wider text-center mb-6">
                ADMIN <i class="fa-solid fa-rocket"></i>
            </h1>
            <!-- Bars Button (Mobile) -->
            <button id="hamburger-menu" class="lg:hidden p-2 text-gray-700 hover:text-gray-900 transition">
                <i class="fa-solid fa-bars" style="font-size: 30px"></i>
            </button>
        </div>
        <div id="nav-container" class="hidden lg:flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <!-- Spacer for alignment (Desktop) -->
            <div class="w-24"></div>
            <div id="nav-links" class="flex flex-col lg:flex-row lg:items-center space-y-4 lg:space-y-0 lg:space-x-20">
                <a href="{{ route('admin.catalogs.list') }}"
                    class="text-lg {{ Route::currentRouteName() == 'admin.catalogs.list' ? 'text-blue-400 border-b-2 border-blue-400' : 'text-gray-600 hover:text-gray-900 transition' }}">
                    Katalog
                </a>
                <a href="{{ route('admin.dashboard') }}"
                    class="text-lg {{ Route::currentRouteName() == 'admin.dashboard' ? 'text-blue-400 border-b-2 border-blue-400' : 'text-gray-600 hover:text-gray-900 transition' }}">
                    Home
                </a>
                <a href="{{ route('admin.list-orders') }}"
                    class="text-lg {{ Route::currentRouteName() == 'admin.list-orders' ? 'text-blue-400 border-b-2 border-blue-400' : 'text-gray-600 hover:text-gray-900 transition' }}">
                    Pesanan
                </a>
            </div>
            <div class="mt-4 lg:mt-0">
                @auth
                    <form action="{{ route('logout') }}" method="GET">
                        @csrf
                        <button type="submit"
                            class="flex items-center text-white text-lg bg-[#3FA3FF] hover:bg-blue-500 font-medium rounded-lg px-4 py-2 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}">
                        <button type="button"
                            class="flex items-center text-white text-lg bg-[#3FA3FF] hover:bg-blue-500 font-medium rounded-lg px-4 py-2 transition duration-300">
                            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Login
                        </button>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
<hr>
{{-- JAVASCRIPT --}}
<script>
    document.getElementById('hamburger-menu').addEventListener('click', () => {
        const navContainer = document.getElementById('nav-container');
        if (window.innerWidth < 1024) { // Pastikan hanya untuk layar kecil
            navContainer.classList.toggle('hidden');
        }
    });
</script>

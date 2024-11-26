<nav class="py-6">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold tracking-wider text-center mb-6">
            DEMANKCO
        </h1>
        <div class="flex items-center justify-between">
            <div class="w-24">
                @auth
                    <div class="flex items-center">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                            stroke="currentColor" class="w-6 h-6 text-gray-600 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg> --}}
                        {{-- <span class="text-gray-600 font-medium">
                            {{ Auth::user()->name ?? Auth::user()->email }}
                        </span> --}}
                    </div>
                @endauth
            </div>
            <div class="flex items-center space-x-20">
                <a href="{{ route('catalogs.list') }}"
                    class="text-lg {{ Route::currentRouteName() == 'catalogs.list' ? 'text-blue-400 border-b-2 border-blue-400' : 'text-gray-600 hover:text-gray-900 transition ' }}">
                    Katalog
                </a>
                <a href="{{ route('dashboard') }}"
                    class="text-lg {{ Route::currentRouteName() == 'dashboard' ? 'text-blue-400 border-b-2 border-blue-400' : 'text-gray-600 hover:text-gray-900 transition' }}">
                    Home
                </a>
                <a href="/pesanan"
                    class="text-lg {{ Route::currentRouteName() == 'pesanan' ? 'text-blue-400 border-b-2 border-blue-400' : 'text-gray-600 hover:text-gray-900 transition' }}">
                    Pesanan
                </a>
            </div>
            <div class="w-24">
                @auth
                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="GET">
                        @csrf
                        <button type="submit"
                            class="flex items-center text-white text-lg bg-blue-500 hover:bg-blue-600 font-medium rounded-lg px-4 py-2 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            Logout
                        </button>
                    </form>
                @else
                    <!-- Login Button -->
                    <a href="{{ route('login') }}">
                        <button type="button"
                            class="flex items-center text-white text-lg bg-blue-500 hover:bg-blue-600 font-medium rounded-lg px-4 py-2 transition duration-300">
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
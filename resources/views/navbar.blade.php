        <!-- Navbar -->
        <nav class="py-6">
            <div class="container mx-auto px-4">
                <!-- Logo -->
                <h1 class="text-4xl font-bold tracking-wider text-center mb-6">
                    DEMANKCO
                </h1>

                <!-- Navigation Links -->
                <div class="flex items-center justify-center space-x-20 pb-4">
                    <a href="{{ route('catalog') }}"
                        class="text-lg {{ Route::currentRouteName() == 'catalog' ? 'text-blue-400 border-b-2 border-blue-400' : 'text-gray-600 hover:text-gray-900 transition '}}">Katalog</a>
                    <a href="{{ route('dashboard') }}" 
                        class="text-lg {{ Route::currentRouteName() == 'dashboard' ? 'text-blue-400 border-b-2 border-blue-400' : 'text-gray-600 hover:text-gray-900 transition' }}">Home</a>
                    <a href="/pesanan" class="text-lg {{ Route::currentRouteName() == 'pesanan' ? 'text-blue-400 border-b-2 border-blue-400' : 'text-gray-600 hover:text-gray-900 transition' }}">Pesanan</a>
                </div>

                <div class="container mx-auto px-2.5 flex justify-end">
                    @auth
                        <!-- Logout Button if user is authenticated -->
                        <form action="{{ route('logout') }}" method="GET">
                            @csrf
                            <button type="submit"
                                class="flex items-center text-white text-lg bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg px-2 py-2 text-center me-2 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                </svg>

                                <span>Logout</span>
                            </button>
                        </form>
                    @else
                        <!-- Login Button if user is a guest -->
                        <a href="{{ route('login') }}">
                            <button type="button"
                                class="flex items-center text-white text-lg bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg px-2 py-2 text-center me-2 mb-2">
                                <svg class="h-8 w-8 text-gray-100 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Login</span>
                            </button>
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
        <hr>
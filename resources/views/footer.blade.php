<footer class="mx-auto w-full max-w-container px-4 sm:px-6 lg:px-8">
    <div class="border-t border-slate-900/5 py-10">
        <div class="flex flex-col items-center">
            <img src="/images/logo_dmco.png" alt="Logo DMCO" class="w-44 h-auto mx-auto">
            <p class="mt-5 text-center text-xl leading-6 text-slate-500">DEMANKCO © 2024 - All rights reserved.</p>
            <div class="mt-8 flex items-center justify-center space-x-4 text-xl font-semibold leading-6 text-slate-700">
                <a href="{{ route('login') }}">Login</a>
                <div class="h-4 w-px bg-slate-500/20"></div>
                <a href="{{ route('register') }}">Daftar</a>
                <div class="h-4 w-px bg-slate-500/20"></div>
                <a href="{{ route('catalogs.list') }}">Katalog</a>
            </div>
        </div>
    </div>
</footer>

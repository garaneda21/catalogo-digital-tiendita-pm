<nav class="bg-crema-claro px-6 py-3 mx-auto max-w-7xl">
    <div class="flex items-center justify-between">
        <!-- Logo -->
        <div class="text-xl font-bold text-azul-profundo">
            <h1>Tiendita PM</h1>
        </div>

        <!-- Botón hamburguesa para móviles -->
        <button id="menu-btn" class="sm:hidden text-azul-profundo focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Menú en pantallas grandes -->
        <div class="hidden sm:flex items-center gap-4">
            <!-- Enlaces del menú -->
            <div class="flex items-center font-bold gap-4 text-sm text-melocoton">
                <a href="#" class="hover:underline">Inicio</a>
                <a href="#" class="hover:underline">Catálogo</a>
                <a href="#" class="hover:underline">Nosotros</a>
                <a href="#" class="hover:underline">Contacto</a>
            </div>

            <!-- Línea separadora -->
            <div class="h-5 w-[1px] bg-[#D9CBB6] mx-1"></div>

            <!-- Autenticación -->

            @if (Route::has('login'))
                <div class="flex items-center gap-6 text text-azul-profundo font-semibold">
                    <nav class="flex items-center justify-end gap-4">
                        @auth
                            <!-- aqui iria algo que muestre el usuario logeado-->
                            <!-- También que le permita deslogearse -->
                        @else
                            <a href="{{ route('login') }}" class="py-1 hover:underline">Iniciar Sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-4 py-1 rounded-2xl border-1 border-azul-profundo hover:bg-azul-profundo hover:text-blanco transition-colors duration-200">Registrarse</a>
                            @endif
                        @endauth
                    </nav>
                </div>
            @endif
        </div>
    </div>

    <!-- Menú desplegable en pantallas pequeñas -->
    <div id="mobile-menu" class="hidden sm:hidden mt-4 flex-col gap-3 font-bold text-center text-[#3D3C63]">
        <hr class="border-1 border-[#D9CBB6] my-2">

        <div class="text-melocoton">
            <a href="#" class="block py-3 hover:underline">Inicio</a>
            <a href="#" class="block py-3 hover:underline">Catálogo</a>
            <a href="#" class="block py-3 hover:underline">Nosotros</a>
            <a href="#" class="block py-3 hover:underline">Contacto</a>
        </div>

        <hr class="border-1 border-[#D9CBB6] my-2">

        <a href="{{ route('login') }}" class="block py-3 hover:underline">Iniciar Sesión</a>
        <a href="{{ route('register') }}"
            class="block mt-2 py-3 rounded-2xl border-1 border-azul-profundo hover:bg-azul-profundo hover:text-blanco transition-colors duration-200">Registrarse</a>
    </div>

    <script>
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</nav>

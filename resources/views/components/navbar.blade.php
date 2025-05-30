<nav class="px-6 py-3 mx-auto max-w-7xl">
    <div class="flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="text-xl font-bold text-azul-profundo">
            <h1>Tiendita PM</h1>
        </a>

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
                            <div class="relative">
                                <!-- Botón -->
                                <button id="userDropdownButton"
                                    class="flex items-center py-1 px-2 hover:bg-black/10 rounded-3xl focus:outline-none">
                                    Hola, {{ auth()->user()->name }} <x-iconos.flecha-sinlinea-abajo />
                                </button>

                                <!-- Dropdown -->
                                <div id="userDropdownMenu"
                                    class="hidden absolute overflow-hidden right-0 mt-2 w-48 bg-azul-profundo rounded-xl shadow-lg z-50">
                                    <!-- Compras cliente -->
                                    <a href="#"
                                        class="flex items-center gap-2 px-4 py-2 text-sm text-blanco hover:underline">
                                        <x-iconos.bolsita /> Mis Compras
                                    </a>
                                    <!-- Configuracion -->
                                    <a href="{{ route('settings.profile') }}"
                                       class="flex items-center gap-2 px-4 py-2 text-sm text-blanco hover:underline">
                                        <x-iconos.cog />
                                        {{ __('Ajustes') }}
                                    </a>
                                    <!-- Cerrar sesión -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-400 hover:underline hover:cursor-pointer">
                                            <x-iconos.salir />Cerrar sesión
                                        </button>
                                    </form>
                                </div>
                            </div>
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

        @if (Route::has('login'))
            @auth
                <a href="#" class="block py-3 hover:underline">Configuración</a>
                <div
                    class="block mt-2 py-3 cursor-pointer rounded-2xl border-1 text-red-400 border-red-400 hover:bg-black/10 transition-colors duration-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="cursor-pointe class="cursor-pointer"r">Cerrar sesión</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="block py-3 hover:underline">Iniciar Sesión</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="block mt-2 py-3 rounded-2xl border-1 border-azul-profundo hover:bg-azul-profundo hover:text-blanco transition-colors duration-200">Registrarse</a>
                @endif
            @endauth
        @endif


    </div>

    <script>
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('userDropdownButton');
            const menu = document.getElementById('userDropdownMenu');
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });
            document.addEventListener('click', function(e) {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>
</nav>

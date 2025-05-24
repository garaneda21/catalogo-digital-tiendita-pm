<nav class="bg-[#f8e9d4] px-6 py-3 mx-auto max-w-7xl">
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
                            <div class="relative">
                                <button id="dropdownButton" type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                                    Hola {{auth()->user()->name}}!
                                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            
                                <div id="dropdownMenu" 
                                     class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden" {{-- Importante: 'hidden' por defecto --}}
                                     role="menu" aria-orientation="vertical" aria-labelledby="dropdownButton" tabindex="-1">
                                    <div class="py-1" role="none">
                                        <div class="grid flex-1 text-start text-sm leading-tight">
                                            <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                            <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                        </div>
                                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Mis compras') }}</flux:menu.item>
                                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                                            @csrf
                                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full cursor-pointer">
                                                {{ __('Log Out') }}
                                            </flux:menu.item>
                                        </form>
                                    </div>
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

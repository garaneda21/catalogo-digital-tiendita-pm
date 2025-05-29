<!-- Deja aquí algún código HTML que quieras probar 👀 -->
<!-- Deja aquí algún código HTML que quieras probar 👀 -->
<!-- Deja aquí algún código HTML que quieras probar 👀 -->

<!-- Y luevo vé a la ruta /test -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body>

<div class="min-h-screen flex bg-[#1f2a24] text-[#f3f4f6]">
    <!-- Sidebar -->
    <aside class="w-64 bg-[#2e3d2e] px-4 py-6">
        <h2 class="text-xl font-semibold mb-6">Admin Panel</h2>
        <nav class="space-y-3">
            <a href="#" class="flex items-center gap-3 bg-[#4b6b4b] hover:bg-[#6a8b6a] text-white px-4 py-2 rounded-lg transition shadow font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V5a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1h10a1 1 0 001-1v-6l4 4V7l-4 4z" />
                </svg>
                Clientes
            </a>
            <a href="#" class="flex items-center gap-3 bg-[#4b6b4b] hover:bg-[#6a8b6a] text-white px-4 py-2 rounded-lg transition shadow font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 1010 10A10 10 0 0012 2z" />
                </svg>
                Planes
            </a>
            <a href="#" class="flex items-center gap-3 bg-[#4b6b4b] hover:bg-[#6a8b6a] text-white px-4 py-2 rounded-lg transition shadow font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
                Países
            </a>
            <a href="#" class="flex items-center gap-3 bg-[#4b6b4b] hover:bg-[#6a8b6a] text-white px-4 py-2 rounded-lg transition shadow font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                </svg>
                Etiquetas
            </a>
        </nav>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-4">Bienvenido al Panel</h1>
        <p class="text-[#cbd5e0]">Aquí puedes administrar clientes, planes y más.</p>
    </main>
</div>
</body>

</html>

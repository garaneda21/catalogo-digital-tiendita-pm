{{-- Con extends definimos la estructura descrita en layouts --}}
<x-layouts.estructura>

    <!-- Barra de categorías -->
    <div class="w-full bg-[#f8e9d4] py-2 px-4 overflow-w-auto">
        <div class="flex justify-center space-x-4 whitespace-nowrap">
            <x-categoria-barra href="/productos/categorias/perfumes">Perfumes</x-categoria-barra>
            <x-categoria-barra href="/productos/categorias/skincare">Skincare</x-categoria-barra>
            <x-categoria-barra href="/productos/categorias/maquillaje">Maquillaje</x-categoria-barra>
            <x-categoria-barra href="/productos/categorias/ropa">Ropa</x-categoria-barra>
            <x-categoria-barra href="/productos/categorias/carteras">Carteras</x-categoria-barra>
        </div>
    </div>

    <section class="py-2 px-6 bg-[#f8e9d4]">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between">

            <!-- Texto a la izquierda -->
            <div class="md:w-1/2 text-left">
                <h1 class="text-5xl font-bold mb-4 text-[#3D3C63]">Bienvenida a Tiendita PM</h1>
                <p class="text-[#587A6C] text-lg mb-6 max-w-md">Explora una colección pensada para ti, llena de detalles,
                    colores y productos únicos.</p>
                <a href="/productos"
                    class="mt-6 inline-block bg-[#db928d] text-white font-semibold px-6 py-3 rounded-full hover:bg-[#ca8a85] transition">
                    Ver Catálogo
                </a>
            </div>

            <!-- Logo a la derecha -->
            <div class="md:w-1/2 mt-10 md:mt-0 flex justify-center md:justify-end">
                <img src="/images/logo.jpeg" alt="Logo Tiendita PM" class="max-w-[400px] h-auto" />
            </div>

        </div>
    </section>

    <!-- Destacados -->
    <section class="py-16 px-6 bg-[#fcf6ed]">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-semibold text-center mb-10">Productos Destacados</h2>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition">
                    <img src="https://placehold.co/500x500" alt="Producto 1"
                        class="w-full h-64 object-cover rounded-t-2xl">
                    <div class="p-4">
                        <h3 class="text-lg font-bold">Producto 1</h3>
                        <p class="text-[#D88C4B] font-semibold">$12.000</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition">
                    <img src="https://placehold.co/500x500" alt="Producto 2"
                        class="w-full h-64 object-cover rounded-t-2xl">
                    <div class="p-4">
                        <h3 class="text-lg font-bold">Producto 2</h3>
                        <p class="text-[#D88C4B] font-semibold">$15.500</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition">
                    <img src="https://placehold.co/500x500" alt="Producto 3"
                        class="w-full h-64 object-cover rounded-t-2xl">
                    <div class="p-4">
                        <h3 class="text-lg font-bold">Producto 3</h3>
                        <p class="text-[#D88C4B] font-semibold">$18.990</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categorías -->
    <section class="py-16 px-6 bg-[#fcf6ed]">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-semibold text-center mb-10">Categorías</h2>
            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <img src="https://placehold.co/500x500" alt="Perfumes" class="mx-auto mb-4">
                    <h3 class="text-lg font-bold text-[#D88C4B]">Perfumes</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <img src="https://placehold.co/500x500" alt="Skincare" class="mx-auto mb-4">
                    <h3 class="text-lg font-bold text-[#D88C4B]">Skincare</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <img src="https://placehold.co/500x500" alt="Maquillaje" class="mx-auto mb-4">
                    <h3 class="text-lg font-bold text-[#D88C4B]">Maquillaje</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <img src="https://placehold.co/500x500" alt="Ropa" class="mx-auto mb-4">
                    <h3 class="text-lg font-bold text-[#D88C4B]">Ropa</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Nosotros -->
    <section class="py-16 px-6 bg-[#f8e9d4]">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-bold text-center mb-10 text-[#D88C4B]">Nosotros</h2>
            <p class="text-[#3D3C63] text-lg max-w-xl mx-auto">Explora una colección pensada para ti, llena de detalles,
                colores y productos únicos.</p>
        </div>
    </section>

    </x-components.layouts.estructura>

    @section('titulo_catalogo')
        Tiendita PM
    @endsection

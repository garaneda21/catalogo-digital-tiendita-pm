{{-- Con extends definimos la estructura descrita en layouts --}}
<x-layouts.estructura>
    <!-- Hero -->
    <section class="text-center py-20 px-6 bg-[#f8e9d4]">
        <h1 class="text-5xl font-bold mb-4 text-[#3D3C63]">Bienvenida a Tiendita PM</h1>
        <p class="text-[#587A6C] text-lg max-w-xl mx-auto">Explora una colección pensada para ti, llena de detalles, colores y productos únicos.</p>
        <a href="#catalogo" class="mt-6 inline-block bg-[#db928d] text-white font-semibold px-6 py-3 rounded-full hover:bg-[#ca8a85] transition">Ver Catálogo</a>
    </section>

    <!-- Destacados -->
    <section class="py-16 px-6 bg-[#fcf6ed]">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-semibold text-center mb-10">Productos Destacados</h2>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition">
                    <img src="https://placehold.co/500x500" alt="Producto 1" class="w-full h-64 object-cover rounded-t-2xl">
                    <div class="p-4">
                        <h3 class="text-lg font-bold">Producto 1</h3>
                        <p class="text-[#D88C4B] font-semibold">$12.000</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition">
                    <img src="https://placehold.co/500x500" alt="Producto 2" class="w-full h-64 object-cover rounded-t-2xl">
                    <div class="p-4">
                        <h3 class="text-lg font-bold">Producto 2</h3>
                        <p class="text-[#D88C4B] font-semibold">$15.500</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition">
                    <img src="https://placehold.co/500x500" alt="Producto 3" class="w-full h-64 object-cover rounded-t-2xl">
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

</x-components.layouts.estructura>

@section('titulo_catalogo')
    Tiendita PM
@endsection

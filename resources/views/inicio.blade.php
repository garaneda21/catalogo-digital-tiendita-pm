{{-- Con extends definimos la estructura descrita en layouts --}}
<x-layouts.estructura>

    <section class="py-2 px-6 bg-crema">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between">

            <!-- Texto a la izquierda -->
            <div class="md:w-1/2 text-left">
                <h1 class="text-5xl font-bold mb-4 text-azul-profundo">Bienvenida a Tiendita PM</h1>
                <p class="text-verde-oliva font-semibold text-lg mb-6 max-w-md">Explora una colección pensada para ti,
                    llena de
                    detalles,
                    colores y productos únicos.</p>
                <a href="/productos"
                    class="mt-6 inline-block bg-terracota text-white font-semibold px-6 py-3 rounded-full hover:bg-terracota/70">
                    Ver Catálogo
                </a>
            </div>

            <!-- Logo a la derecha -->
            <div class="md:w-1/2 mt-10 md:mt-0 flex justify-center md:justify-end">
                <img src="/images/logo.jpeg" alt="Logo Tiendita PM" class="max-w-[400px] h-auto" />
            </div>

        </div>
    </section>

    <section class="w-full px-6 py-8 bg-crema-claro">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-azul-profundo mb-4">Productos Destacados</h2>

            <div class="overflow-x-auto">
                <div class="flex space-x-4">
                    @foreach ($destacados as $producto)
                        <div class="min-w-[200px] bg-white rounded-xl border border-gray-200">
                            <a href="/productos/{{ $producto->slug }}">
                                <img src="{{ $producto->imagen_url ? asset('storage/' . $producto->imagen_url) : '/images/placeholder-product.jpg' }}"
                                    alt="" class="w-full h-48 object-cover rounded-t-xl">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-azul-profundo mb-1">
                                        {{ $producto->nombre_producto }}
                                    </h3>
                                    <a
                                        class="text-sm text-gray-500 mb-2">{{ $producto->categoria->nombre_categoria }}</a>
                                    <p class="text-verde-oliva font-bold text-base">${{ $producto->precio }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="w-full px-6 py-8 bg-crema-claro">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-azul-profundo mb-4">Productos Nuevos</h2>

            <div class="overflow-x-auto">
                <div class="flex space-x-4">
                    @foreach ($nuevos as $producto)
                        <div class="min-w-[200px] bg-white rounded-xl border border-gray-200">
                            <a href="/productos/{{ $producto->slug }}">
                                <img src="{{ $producto->imagen_url ? asset('storage/' . $producto->imagen_url) : '/images/placeholder-product.jpg' }}"
                                    alt="" class="w-full h-48 object-cover rounded-t-xl">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-azul-profundo mb-1">
                                        {{ $producto->nombre_producto }}
                                    </h3>
                                    <a
                                        class="text-sm text-gray-500 mb-2">{{ $producto->categoria->nombre_categoria }}</a>
                                    <p class="text-verde-oliva font-bold text-base">${{ $producto->precio }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
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

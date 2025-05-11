<x-layouts.estructura>
    <div class="mx-auto max-w-2xl p-4 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">

        <div>
            {{ $productos->links() }}
        </div>

        <div class="columns-2">
            <x-select-orden>
                <option value="nombre_asc" {{ request('ordering') == 'nombre_asc' ? 'selected' : '' }}>Nombre
                    (A-Z)
                </option>
                <option value="nombre_desc" {{ request('ordering') == 'nombre_desc' ? 'selected' : '' }}>Nombre
                    (Z-A)</option>
                <option value="precio_asc" {{ request('ordering') == 'precio_asc' ? 'selected' : '' }}>Precio
                    (menor
                    a mayor)</option>
                <option value="precio_desc" {{ request('ordering') == 'precio_desc' ? 'selected' : '' }}>Precio
                    (mayor a menor)</option>
            </x-select-orden>
            <x-cuadro-busqueda></x-cuadro-busqueda>
        </div>

        @if ($productos->count() == 0)
            <div class="mt-10 flex flex-col items-center justify-center text-center py-10 text-[#3D3C63]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-4" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="m23.707,22.293l-5.963-5.963c1.412-1.725,2.262-3.927,2.262-6.324C20.006,4.492,15.52.006,10.006.006S.006,4.492.006,10.006s4.486,10,10,10c2.398,0,4.6-.85,6.324-2.262l5.963,5.963c.195.195.451.293.707.293s.512-.098.707-.293c.391-.391.391-1.023,0-1.414Zm-10-10c.391.391.391,1.023,0,1.414-.195.195-.451.293-.707.293s-.512-.098-.707-.293l-2.293-2.293-2.293,2.293c-.195.195-.451.293-.707.293s-.512-.098-.707-.293c-.391-.391-.391-1.023,0-1.414l2.293-2.293-2.293-2.293c-.391-.391-.391-1.023,0-1.414s1.023-.391,1.414,0l2.293,2.293,2.293-2.293c.391-.391,1.023-.391,1.414,0s.391,1.023,0,1.414l-2.293,2.293,2.293,2.293Z" />
                </svg>
                <p class="text-lg font-semibold">No se encontraron productos</p>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 xl:gap-x-8">

            @foreach ($productos as $producto)
                <a href="{{ route('producto.show', $producto->id) }}"
                    class="group text-center">
                    <img src="{{ $producto->imagen_url ?? '/images/placeholder-product.jpg' }}"
                        alt="{{ $producto->nombre_producto }}"
                        class="rounded-2xl border aspect-square w-full object-cover group-hover:opacity-75">
                    <div class="p-2">
                        <h2 class="text-lg font-semibold text-[#3D3C63]">
                            {{ $producto->nombre_producto }}
                        </h2>
                        <p class="text-md text-gray-500 mt-1">{{ $producto->categoria->nombre_categoria }}</p>
                        <p class="text-xl font-bold text-[#587A6C] mt-2">
                            ${{ number_format($producto->precio, 0, ',', '.') }}</p>
                    </div>
                </a>

            @endforeach
        </div>
    </div>
</x-layouts.estructura>

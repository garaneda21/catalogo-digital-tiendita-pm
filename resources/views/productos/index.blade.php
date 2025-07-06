<x-layouts.estructura>
    <div class="mx-auto max-w-6xl p-4">

        @isset($categoria)
            <div class="flex items-center text-azul-profundo space-x-6">
                <h2 class="text-4xl pb-4 font-bold">{{ $categoria }}</h2>
                <p class="text-sm font-semibold text-azul-profundo/90">{{ count($productos) }} productos</p>
            </div>

            <hr>
        @endisset

        <div class="mb-4">
            {{ $productos->links() }}
        </div>

        <x-ordenamiento-y-busqueda></x-ordenamiento-y-busqueda>

        @if ($productos->count() == 0)
            <div class="mt-10 flex flex-col items-center justify-center text-center py-10 text-[#3D3C63]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-4" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="m23.707,22.293l-5.963-5.963c1.412-1.725,2.262-3.927,2.262-6.324C20.006,4.492,15.52.006,10.006.006S.006,4.492.006,10.006s4.486,10,10,10c2.398,0,4.6-.85,6.324-2.262l5.963,5.963c.195.195.451.293.707.293s.512-.098.707-.293c.391-.391.391-1.023,0-1.414Zm-10-10c.391.391.391,1.023,0,1.414-.195.195-.451.293-.707.293s-.512-.098-.707-.293l-2.293-2.293-2.293,2.293c-.195.195-.451.293-.707.293s-.512-.098-.707-.293c-.391-.391-.391-1.023,0-1.414l2.293-2.293-2.293-2.293c-.391-.391-.391-1.023,0-1.414s1.023-.391,1.414,0l2.293,2.293,2.293-2.293c.391-.391,1.023-.391,1.414,0s.391,1.023,0,1.414l-2.293,2.293,2.293,2.293Z" />
                </svg>
                <p class="text-lg font-semibold">No se encontraron productos</p>
            </div>
        @endif

        <div class="grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-3 md:grid-cols-4 xl:gap-x-8">

            @foreach ($productos as $producto)
                @if ($producto->activo)
                    <div
                        class="group relative flex flex-col items-center justify-between bg-white rounded-2xl shadow-lg p-4 hover:shadow-xl transition-shadow duration-300">
                        <a href="/productos/{{ $producto->slug }}" class="group text-center">
                            <img src="{{ $producto->imagen_url ? asset('storage/' . $producto->imagen_url) : '/images/placeholder-product.jpg' }}"
                                alt="{{ $producto->nombre_producto }}"
                                class="rounded-2xl border aspect-square w-full object-cover group-hover:opacity-75">
                            <div class="p-2">
                                <h2 class="text-lg font-semibold text-[#3D3C63]">
                                    {{ $producto->nombre_producto }}
                                </h2>
                                <p class="text-md text-gray-500 mt-1">{{ $producto->categoria->nombre_categoria ?? '' }}
                                </p>
                                <p class="text-xl font-bold text-[#587A6C] mt-2">
                                    ${{ number_format($producto->precio, 0, ',', '.') }}</p>
                            </div>
                        </a>
                        <!-- Botón carrito -->
                        
                        <form action="{{ route('carrito.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            <input type="hidden" name="cantidad" value="1" min="1">
                            <flux:modal.trigger name="desplegar-modal-carrito">        
                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                    Agregar al Carrito</button>
                            </flux:modal.trigger>
                        </form>
                        
                        <!-- Modal con items del carrito -->
                        <flux:modal name="desplegar-modal-carrito" class="w-96 md:w-125">
                            <div class="p-6">
                                <h2 class="text-2xl font-bold text-[#3D3C63] mb-4">Carrito de Compras</h2>
                                <p class="text-melocoton mb-4">Estos son los productos que has agregado a tu carrito:</p>
                                <ul class="space-y-4">
                                    @foreach (session('carrito', []) as $item)
                                        <li class="flex justify-between items-center">
                                            <div>
                                                <h3 class="font-semibold">{{ $item['nombre_producto'] }}</h3>
                                                <p class="text-sm text-gray-600">Cantidad: {{ $item['cantidad'] }}</p>
                                            </div>
                                            <span class="text-lg font-bold text-[#587A6C]">${{ number_format($item['precio'], 0, ',', '.') }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mt-6">
                                    <p class="text-lg font-semibold text-[#3D3C63]">Total:</p>
                                </div>
                                <div class="mt-6 flex justify-end">
                                    <flux:modal.close>
                                        <flux:button variant="ghost">Cerrar</flux:button>
                                    </flux:modal.close>
                            </div>
                        </flux:modal>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-layouts.estructura>

<x-layouts.estructura>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Tu compra ({{ $carrito->items->count() }} productos)</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Columna izquierda: Lista de productos --}}
            <div class="lg:col-span-2 space-y-4 overflow-y-auto" style="max-height: 600px;">
                @foreach($carrito->items as $item)
                    <div class="border rounded-lg p-4 flex items-start gap-4 bg-white">
                        <img src="/images/placeholder-product.jpg" class="w-32 h-32 object-contain" alt="Imagen">

                        <div class="flex-1">
                            <h2 class="font-semibold">{{ $item->producto->nombre_producto }}</h2>
                            <p class="text-sm text-gray-600">{{ $item->producto->categoria->nombre_categoria }}</p>
                            <p class="text-xs text-gray-400">{{ $item->producto->descripcion }}</p>

                            <div class="mt-3 flex items-center gap-2">
                                {{-- Botones para actualizar la cantidad del producto --}}
                                <div class="flex items-center mt-2 gap-2">
                                    <form action="{{ route('carrito.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <span>Cantidad:</span>
                                        <input type="number" name="cantidad" value="{{ $item->cantidad }}" min="1"
       class="w-20 px-3 py-2 border border-gray-300 rounded-lg text-center text-gray-800 shadow-sm
              focus:outline-none focus:ring-2 focus:ring-verde-oliva focus:border-verde-oliva
              transition-all duration-200 ease-in-out font-medium hover:border-verde-oliva" />
                                        <button type="submit" class="bg-verde-oliva hover:bg-verde-oliva/80 text-white rounded-lg px-4 py-2 flex items-center gap-2 shadow-md transition-all duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-verde-oliva/60 focus:ring-opacity-75 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.6M22 12.5A10 10 0 0 1 3.2 17.6"/>
                                            </svg>
                                            <span class="font-semibold text-sm">Actualizar</span>
                                        </button>
                                    </form>
                                </div>

                                <form action="{{ route('carrito.remove', $item->id) }}" method="POST" class="ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-gray-100 hover:bg-red-100 text-red-600 text-sm rounded-lg px-3 py-1 shadow transition flex items-center gap-1 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        <span>Eliminar</span>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="font-bold text-lg">${{ number_format($item->precio_unitario, 0, ',', '.') }}</p>
                            @if ($item->producto->precio_normal)
                                <p class="line-through text-sm text-gray-400">${{ number_format($item->producto->precio_normal, 0, ',', '.') }}</p>
                            @endif
                            @if ($item->producto->descuento)
                                <span class="text-white bg-red-600 text-xs px-2 py-0.5 rounded">
                                    {{ $item->producto->descuento }}%
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Columna derecha: Resumen --}}
            <div class="bg-white p-4 rounded-lg shadow space-y-4 h-fit">
                <h2 class="text-lg font-bold">Resumen de mi compra</h2>

                <div class="space-y-1 text-sm">
                    <div class="flex justify-between">
                        <span>Costo de tus productos</span>
                        <span>${{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <hr>
                    <div class="flex justify-between font-semibold">
                        <span>Subtotal</span>
                        <span>${{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <a href="{{ route('checkout') }}" class="block bg-verde-oliva text-white text-center py-2 rounded hover:bg-verde-oliva/80 transition">
                    Continuar tu compra
                </a>

                <div class="text-sm text-gray-500 border-t pt-2">
                    <p class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l1.6 8M17 13l-1.6 8M9 21h6" />
                        </svg>
                        El costo de envío se calculará en el siguiente paso
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.estructura>

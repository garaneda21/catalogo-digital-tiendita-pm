

@if($carrito->items->count())
    <div class="relative h-full flex flex-col">
        <div class="flex-1 overflow-y-auto pr-2">
            @foreach ($carrito->items as $item)
                <div class="flex items-center space-x-4 py-3 border-b">
                    {{-- Imagen del producto --}}
                    <div class="w-20 h-20 flex-shrink-0">
                        <img src="{{ $item->producto->imagen_url ? asset('storage/' . $item->producto->imagen_url) : '/images/placeholder-product.jpg' }}"
                             alt="{{ $item->producto->nombre_producto }}"
                             class="w-full h-full object-cover rounded-md border">
                    </div>

                    {{-- Detalles del producto --}}
                    <div class="flex-1">
                        <h3 class="font-semibold text-sm">{{ $item->producto->nombre_producto }}</h3>

                        <div class="flex items-center space-x-2 mt-1">
                            <span class="text-sm px-2 font-semibold">Cantidad: {{ $item->cantidad }}</span>
                        </div>
                    </div>

                    {{-- Precio --}}
                    <span class="text-right font-semibold text-sm">
                        ${{ number_format($item->precio_unitario * $item->cantidad, 0, ',', '.') }}
                    </span>
                </div>
            @endforeach
        </div>
        <div class="sticky bottom-0 left-0 right-0 border-t pt-4 flex justify-end items-center bg-white z-10 px-2" style="min-height:4rem;">
            <span class="text-lg font-bold text-[#3D3C63] mr-2">Total:</span>
            <span class="text-lg font-bold text-[#3D3C63]">
                ${{ number_format($total, 0, ',', '.') }}
            </span>
        </div>
    </div>
@else
    <p class="text-gray-500">El carrito está vacío.</p>
@endif

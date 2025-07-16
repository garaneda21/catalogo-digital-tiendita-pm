@if($carrito->items->count())
    <div class="max-h-[400px] overflow-y-auto pr-2">
        @foreach ($carrito->items as $item)
            <div class="flex justify-between items-center py-2 border-b">
                <div>
                    <h3 class="font-semibold">{{ $item->producto->nombre_producto }}</h3>
                    <div class="flex items-center space-x-2 mt-1">
                        <form method="POST" action="{{ route('carrito.update', $item->id) }}" class="form-cantidad" data-item="{{ $item->id }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="cantidad" value="{{ max(1, $item->cantidad - 1) }}">
                            <button type="submit" class="text-lg font-bold px-2">−</button>
                        </form>
                        <span class="text-sm px-2">{{ $item->cantidad }}</span>
                        <form method="POST" action="{{ route('carrito.update', $item->id) }}" class="form-cantidad" data-item="{{ $item->id }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="cantidad" value="{{ $item->cantidad + 1 }}">
                            <button type="submit" class="text-lg font-bold px-2">+</button>
                        </form>
                    </div>
                </div>
                <span class="text-right font-semibold">
                    ${{ number_format($item->precio_unitario * $item->cantidad, 0, ',', '.') }}
                </span>
            </div>
        @endforeach
    </div>

    <div class="border-t pt-4 mt-4 flex justify-end items-center sticky bottom-0 bg-white z-10 px-2">
        <span class="text-lg font-bold text-[#3D3C63] mr-2">Total:</span>
        <span class="text-lg font-bold text-[#3D3C63]">
            ${{ number_format($total, 0, ',', '.') }}
        </span>
    </div>
@else
    <p class="text-gray-500">El carrito está vacío.</p>
@endif

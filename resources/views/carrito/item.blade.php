<div class="flex justify-between items-center border-b py-4">
    <div>
        <h3 class="text-lg font-semibold">{{ $item->producto->nombre }}</h3>
        <p>${{ number_format($item->precio_unitario, 0, ',', '.') }}</p>
    </div>

    <form action="{{ route('carrito.actualizar', $item->id) }}" method="POST" class="flex items-center gap-2">
        @csrf
        <input type="number" name="cantidad" value="{{ $item->cantidad }}" min="1" class="w-16 p-1 border rounded">
        <button class="text-blue-500">Actualizar</button>
    </form>

    <form action="{{ route('carrito.eliminar', $item->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="text-red-500">Eliminar</button>
    </form>
</div>

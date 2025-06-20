<x-layouts.estructura>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Revisa tu pedido</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Productos resumidos --}}
            <div class="lg:col-span-2 space-y-4">
                @foreach ($carrito->items as $item)
                    <div class="border rounded-lg p-4 flex items-start gap-4 bg-white">
                        <img src="{{ $item->producto->imagen_url ? asset('storage/' . $item->producto->imagen_url) : '/images/placeholder-product.jpg' }}" alt="{{ $item->producto->nombre_producto }}" class="w-24 h-24 object-contain">
                        
                        <div class="flex-1">
                            <h2 class="font-semibold">{{ $item->producto->nombre_producto }}</h2>
                            <p class="text-sm text-gray-600">Precio: ${{ $item->producto->precio }}</p>
                            <p class="text-xs text-gray-400">Cantidad: {{ $item->cantidad }}</p>
                            <p class="mt-2 text-sm">Subtotal: ${{ $item->producto->precio * $item->cantidad }}</p>
                        </div>

                        <div class="text-right">
                            <p class="text-lg font-bold">Total: ${{ number_format($item->precio_unitario * $item->cantidad, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Confirmacion y pago --}}
            <div class="bg-white p-4 rounded-lg shadow space-y-4 h-fit">
                <h2 class="text-lg font-bold">Resumen del pago</h2>
                <div class="space-y-1 text-sm">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>${{ number_format($totalSinDescuento, 0, ',', '.') }}</span>
                    </div>
                    <div class ="flex justify-between">
                        <span>Descuentos</span>
                        <span class="text-red-600">-{{ number_format($descuentoTotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Envío</span>
                        <span class="text-gray-500">Por calcular</span>
                    </div>
                    <hr>
                    <div class="flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span>${{ number_format($totalConDescuento, 0, ',', '.') }}</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('webpay.iniciar') }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                        Ir a pagar con Webpay
                    </button>
                </form>

                <p class="text-sm text-gray-500 border-t pt-2">
                    Serás redirigido a Webpay para completar tu compra. Asegúrate de que la información de tu carrito es correcta antes de proceder.
                </p>
            </div>
        </div>
    </div>
</x-layouts.estructura>
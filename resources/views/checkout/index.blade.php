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

            @guest
                <div class="bg-[#fef9c3] border border-yellow-300 rounded-lg p-4 text-sm text-gray-800">
                    <p class="fonr-semibold">¿Ya tienes una cuenta?</p>
                    <p class="mt-1">Te recomendamos iniciar sesión o registrarte.</p>
                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Iniciar sesión</a>
                        <span>|</span>
                        <a href="{{ route('register') }}" class="text-green-600 hover:underline font-medium">Crear cuenta</a>
                    </div>
                </div>
            @endguest

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

                <div class="text-sm text-gray-500 border-t pt-2">
                    <p class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l1.6 8M17 13l-1.6 8M9 21h6" />
                        </svg>
                        El costo de envío se calculará en el siguiente paso
                    </p>
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
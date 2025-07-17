<x-layouts.estructura>
    <div class="max-w-6xl mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
            <!-- Imagen del producto -->
            <div class="w-full">
                <img src="{{ $producto->imagen_url ? asset('storage/' . $producto->imagen_url) : '/images/placeholder-product.jpg' }}"
                    alt="{{ $producto->nombre_producto }}" class="rounded-2xl border w-full object-cover">
            </div>

            <!-- Información del producto -->
            <div class="space-y-6">

                <h1 class="text-3xl font-bold text-azul-profundo">{{ $producto->nombre_producto }}</h1>

                <p class="text-2xl text-verde-oliva font-semibold">${{ number_format($producto->precio, 0, ',', '.') }}</p>

                <!-- Botones -->
                <div class="flex gap-4 mt-4">
                    <!-- Botón carrito -->
                    <form class="form-add-to-cart" action="{{ route('carrito.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                        <input type="hidden" name="cantidad" value="1" min="1">
                        <flux:modal.trigger name="desplegar-modal-carrito">
                            <button type="submit"
                                class="bg-melocoton text-white px-5 py-2 rounded-full hover:bg-melocoton/75 cursor-pointer">
                                Agregar al Carrito</button>
                        </flux:modal.trigger>
                    </form>

                    <!-- Botón WhatsApp -->
                    <a href="https://wa.me/56979828311?text={{ urlencode('Hola!, estoy interesad@ en el producto ' . $producto->nombre_producto) }}"
                        target="_blank"
                        class="bg-verde-oliva hover:bg-verde-oliva/75 text-white px-5 py-2 rounded-full flex items-center gap-2">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 32 32">
                            <path
                                d="M16 .1C7.2.1.1 7.2.1 16c0 2.8.7 5.4 2 7.7L0 32l8.5-2.2c2.2 1.2 4.7 1.8 7.4 1.8 8.8 0 15.9-7.1 15.9-15.9S24.8.1 16 .1zm0 29.1c-2.4 0-4.7-.7-6.7-1.9l-.5-.3-5 1.3 1.3-4.9-.3-.5c-1.2-2-1.9-4.3-1.9-6.7 0-7.2 5.9-13.1 13.1-13.1 7.2 0 13.1 5.9 13.1 13.1.1 7.2-5.8 13-13.1 13zm7.2-9.8c-.4-.2-2.3-1.1-2.7-1.2-.4-.1-.7-.2-1 .2s-1.1 1.2-1.4 1.5c-.2.2-.5.3-.9.1-2.4-1.2-3.9-2.1-5.5-4.8-.4-.6 0-.9.3-1.2.3-.3.6-.7.9-1.1.3-.3.4-.5.6-.8.2-.3.1-.6 0-.8-.2-.2-1-2.4-1.4-3.3-.4-.9-.8-.8-1.1-.8h-.9c-.3 0-.8.1-1.2.6s-1.6 1.6-1.6 3.8c0 2.2 1.7 4.3 1.9 4.6.2.3 3.3 5 8.1 6.8.7.3 1.3.5 1.8.6.8.3 1.5.3 2 .2.6-.1 2.3-.9 2.6-1.8.3-.9.3-1.6.2-1.8-.1-.2-.4-.3-.8-.5z" />
                        </svg>
                        WhatsApp
                    </a>
                </div>

                <p class="text-gray-600">Descripción:<br>{{ $producto->descripcion }}</p>

            </div>
        </div>
    </div>
</x-layouts.estructura>

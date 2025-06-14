<x-layouts.estructura>
    <div class="max-w-4xl mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Mi carrito</h2>

        @foreach ($carrito->items as $item)
            @include('carrito.item', ['item' => $item])
        @endforeach

        <div class="text-right mt-6">
            <a href="{{ Auth::guard('web')->check() ? route('checkout') : route('login') }}"
               class="bg-green-500 text-white px-4 py-2 rounded">
               Proceder al Pago
            </a>
        </div>
    </div>
</x-layouts.estructura>

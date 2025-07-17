<x-layouts.estructura>
    <section class="py-16 px-4 bg-[#f8e9d4] min-h-screen">
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8 text-center">

            <div class="mb-6">
                <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2l4 -4m6 2a10 10 0 1 1 -20 0a10 10 0 0 1 20 0z" />
                </svg>
                <h1 class="text-3xl font-bold text-green-600 mt-4">¡Pago exitoso!</h1>
                <p class="text-gray-700 mt-2">Tu compra fue procesada correctamente.</p>
            </div>

            <div class="text-left bg-[#fcf6ed] p-6 rounded-xl">
                <div class="text-center">
                    <p class="text-sm text-gray-500 mb-1">Número de pedido:</p>
                    <p class="text-[#3D3C63] font-semibold mb-6">{{ $response->getBuyOrder() }}</p>
                </div>
                <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
                    <div>
                        <p class="font-semibold text-[#D88C4B]">Fecha</p>
                        <p>{{ now()->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-[#D88C4B]">Código de autorización</p>
                        <p>{{ $response->getAuthorizationCode() }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-[#D88C4B]">Tarjeta</p>
                        <p>**** **** **** {{ $response->getCardDetail()['card_number'] ?? '****' }}</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('inicio') }}"
                class="mt-8 inline-block bg-[#db928d] text-white font-semibold px-6 py-2 rounded-full hover:bg-[#ca8a85] transition">
                Volver al inicio
            </a>
        </div>
    </section>
</x-layouts.estructura>

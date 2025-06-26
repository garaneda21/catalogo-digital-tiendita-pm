<x-layouts.estructura>
    <section class="py-16 px-6 bg-[#f8e9d4] min-h-screen flex flex-col items-center justify-center">
        <div class="max-w-xl w-full mx-auto bg-white rounded-2xl shadow-lg p-8 text-center">

            <div class="mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg> 
                <h1 class="text-3xl font-bold text-red-600 mt-4">¡Pago Rechazado!</h1>
                <p class="text-gray-700 mt-2">{{ $mensaje ?? 'Lamentablemente, tu pago no fue aprobado.' }}</p>
                <p class="text-gray-600 mt-1 text-sm">Por favor revisa los detalles y vuelve a intentarlo.</p>
            </div>

            @if(isset($response))
                <div class="bg-[#fcf6ed] p-6 rounded-xl shadow-inner text-left text-sm text-gray-700">
                    <p class="mb-2"><strong class="text-[#D88C4B]">Número de pedido:</strong> {{ optional($response)->getBuyOrder() ?? 'Desconocido' }}</p>
                    <p class="mb-2"><strong class="text-[#D88C4B]">Estado:</strong> Pago no aprobado</p> 
                    <p class="text-center mt-4"><strong class="text-[#C0504D]">Por favor intenta nuevamente o usa otro método de pago.</strong></p>
                </div>
            @else
                <div class="bg-[#fcf6ed] p-6 rounded-xl shadow-inner text-sm text-gray-700">
                    <p class="text-center">No se proporcionaron detalles del pago.</p>
                </div>
            @endif
            <a href="{{ route('carrito.index') }}"
                class="mt-8 inline-block bg-[#db928d] text-white font-semibold px-6 py-2 rounded-full hover:bg-[#ca8a85] transition">
                Volver al Carrito
            </a>
        </section>
</x-layouts.estructura>
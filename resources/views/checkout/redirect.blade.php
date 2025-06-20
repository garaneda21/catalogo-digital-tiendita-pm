<x-layouts.estructura>
    <section class="min-h-screen bg-[#f8e9d4] flex items-center justify-center px-6">
        <div class="bg-white rounded-2xl shadow-lg p-8 max-w-md w-full text-center space-y-4">
            <h1 class="text-2xl font-bold text-[#3D3C63]">Redirigiendo al portal de pago...</h1>
            <p class="text-gray-600">Por favor, no cierres esta ventana.</p>

            <form id="webpay-form" action="{{ $url }}" method="POST">
                @csrf
                <input type="hidden" name="token_ws" value="{{ $token }}">
                <noscript>
                    <p class="text-red-600 mb-4">Tu navegador no permite redireccion automática.</p>
                    <button 
                      type="submit" 
                      class="bg-[#db928d] hover:bg-[#ca8a85] text-white font-semibold px-6 py-2 rounded-full transition">
                        Ir a Webpay
                    </button>
                </noscript>
            </form>
        </div>
    </section>

    <script>
        document.getElementById('webpay-form').submit();
    </script>
</x-layouts.estructura>

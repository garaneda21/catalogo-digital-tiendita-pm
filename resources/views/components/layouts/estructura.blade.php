{{-- Esta define la estructura (header, footer) de las vistas que aparezcan en el sitio web  --}}
{{-- En este caso lo que variaría en cada pagina es el titulo (@yield('titulo')) y el
contenido @yield('contenido_catalogo') --}}

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Descubre los mejores productos de belleza en Tiendita PM. Perfumes, skincare, maquillaje y más. ¡Compra directo por WhatsApp!">
    <title>@yield('titulo_catalogo')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>

<body>
    <header class="bg-crema">
        <x-navbar />
    </header>

    <div class="bg-blanco min-h-screen">

        @if (session('success'))
            <div id="success-alert" class="bg-green-100 text-green-700 p-4 rounded-lg mb-4 flex justify-between items-center shadow-md" role="alert">
                <span>{{ session('success') }}</span>
                <button type="button" class="text-green-700 hover:text-green-900 ml-4" onclick="document.getElementById('success-alert').style.display='none';">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const successAlert = document.getElementById('success-alert');
                    if (successAlert) {
                        setTimeout(() => {
                            successAlert.style.transition = 'opacity 0.5s ease-out';
                            successAlert.style.opacity = '0';
                            setTimeout(() => successAlert.remove(), 500); // Elimina después de la transición
                        }, 3000); // El mensaje desaparece después de 5 segundos (5000 ms)
                    }
                });
            </script>
        @endif
        
        @if (session('error'))
            <div id="error-alert" class="bg-red-100 text-red-700 p-4 rounded-lg mb-4 flex justify-between items-center shadow-md" role="alert">
                <span>{{ session('error') }}</span>
                <button type="button" class="text-red-700 hover:text-red-900 ml-4" onclick="document.getElementById('error-alert').style.display='none';">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const errorAlert = document.getElementById('error-alert');
                    if (errorAlert) {
                        setTimeout(() => {
                            errorAlert.style.transition = 'opacity 0.5s ease-out';
                            errorAlert.style.opacity = '0';
                            setTimeout(() => errorAlert.remove(), 500); // Elimina después de la transición
                        }, 5000); // El mensaje de error desaparece después de 7 segundos
                    }
                });
            </script>
        @endif

        {{ $slot }}
        <!-- Modal con items del carrito que se despliega al añadir un producto-->
        <flux:modal name="desplegar-modal-carrito" class="w-full max-w-[800px]">
            <div class="p-6 flex flex-col h-[80vh]">
                <h2 class="text-2xl font-bold text-[#3D3C63] mb-4">Carrito de Compras</h2>
                <p class="text-melocoton mb-4">Productos agregados:</p>

                <div id="contenido-carrito" class="flex-1 overflow-y-auto border rounded p-4 bg-white">
                    <!-- Se carga dinámicamente -->
                </div>

                <div class="mt-4 flex justify-end">
                    <flux:button variant="primary" class="mr-2" onclick="location.href='{{ route('carrito.index') }}'">
                        Ir al carrito
                    </flux:button>
                    <flux:button variant="ghost" onclick="location.href='{{ url('/productos') }}'">Seguir comprando</flux:button>
                </div>
            </div>
        </flux:modal>


    </div>

    <footer id="contacto" class="bg-azul-profundo text-white py-12">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-6 text-center">
            <!-- Contacto -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Contáctanos</h3>
                <p>Email: hola@tienditapm.cl</p>
                <p>WhatsApp: +56 9 1234 5678</p>
            </div>
            <!-- Redes Sociales -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Síguenos</h3>
                <ul>
                    <li><a href="#" class="hover:underline">Instagram</a></li>
                    <li><a href="#" class="hover:underline">Facebook</a></li>
                    <li><a href="#" class="hover:underline">TikTok</a></li>
                </ul>
            </div>
            <!-- Nosotros -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Nosotros</h3>
                <p>Pequeño emprendimiento con alma creativa. Diseñamos con pasión para ti.</p>
            </div>
        </div>
        <div class="text-center mt-8 text-sm text-mostaza">© 2025 Tiendita PM. Todos los derechos reservados.</div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>

    <!-- Script para actualizar el contenido del carrito -->
    <script>
    async function actualizarContenidoCarrito() {
        const res = await fetch('{{ route('carrito.contenido') }}');
        const html = await res.text();
        document.getElementById('contenido-carrito').innerHTML = html;

        document.querySelectorAll('.form-cantidad').forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const action = form.getAttribute('action');
                const token = form.querySelector('input[name="_token"]').value;
                const cantidad = form.querySelector('input[name="cantidad"]').value;

                const res = await fetch(action, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ cantidad })
                });

                if (res.ok) {
                    await actualizarContadorCarrito();
                    await actualizarContenidoCarrito();
                }
            });
        });
    }

    document.querySelectorAll('.form-add-to-cart').forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const action = form.getAttribute('action');
            const token = form.querySelector('input[name="_token"]').value;
            const producto_id = form.querySelector('input[name="producto_id"]').value;
            const cantidad = form.querySelector('input[name="cantidad"]').value;

            const response = await fetch(action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ producto_id, cantidad })
            });

            if (response.ok) {
                await actualizarContadorCarrito();
                await actualizarContenidoCarrito();
                Flux.open('desplegar-modal-carrito');
            }
        });
    });
     // Ejecutar al cargar la página
    window.addEventListener('DOMContentLoaded', () => {
        actualizarContadorCarrito();
    });
    </script>


    @fluxScripts
</body>

</html>

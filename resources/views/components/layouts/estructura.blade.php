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
        {{ $slot }}

        <!-- Modal lateral del carrito -->
        <div id="carritoSidebar" class="fixed right-0 top-0 w-full max-w-md h-full bg-white shadow-lg z-50 transform translate-x-full transition duration-300 ease-in-out overflow-y-auto">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-lg font-semibold">Mi Carro (<span id="total-items">0</span> productos)</h2>
                <button onclick="cerrarCarrito()" class="text-gray-600 hover:text-black">&times;</button>
            </div>
        
            <div id="contenido-carrito" class="p-4 space-y-4">
                {{-- Aquí se inyectan dinámicamente los productos con JS --}}
            </div>
        
            <div class="p-4 border-t text-sm space-y-1">
                <p>Subtotal: <strong id="subtotal" class="float-right">$0</strong></p>
                <p><a href="{{ route('carrito.index') }}" class="text-blue-600 hover:underline">Ir al carrito de compras</a></p>
                <a href="{{ route('checkout') }}" class="block text-center bg-red-600 text-white py-2 rounded mt-2 hover:bg-red-700 transition">
                    Continuar mi compra
                </a>
            </div>
        </div>
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

    <!-- Sidebar del carrito -->

    <script>
    function abrirCarrito() {
        document.getElementById('carritoSidebar').classList.remove('translate-x-full');
    }
    
    function cerrarCarrito() {
        document.getElementById('carritoSidebar').classList.add('translate-x-full');
    }
    
    function agregarAlCarrito(productoId) {
        fetch(`/api/carrito/agregar/${productoId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cantidad: 1 })
        })
        .then(response => response.json())
        .then(data => {
            actualizarCarritoSidebar(data.carrito);
            abrirCarrito();
        });
    }
    
    function actualizarCarritoSidebar(carrito) {
        const contenedor = document.getElementById('contenido-carrito');
        contenedor.innerHTML = '';
    
        let subtotal = 0;
        let totalItems = 0;
    
        carrito.items.forEach(item => {
            subtotal += item.precio_unitario * item.cantidad;
            totalItems += item.cantidad;
        
            contenedor.innerHTML += `
                <div class="flex gap-4 border-b pb-4">
                    <img src="${item.producto.imagen_url}" alt="${item.producto.nombre_producto}" class="w-20 h-20 object-cover">
                    <div class="flex-1">
                        <h4 class="font-semibold">${item.producto.nombre_producto}</h4>
                        <p class="text-sm text-gray-600">Precio: $${item.precio_unitario.toLocaleString()}</p>
                        <div class="flex items-center mt-2 gap-2">
                            <button onclick="actualizarCantidad(${item.id}, -1)" class="bg-gray-300 px-2">-</button>
                            <span>${item.cantidad}</span>
                            <button onclick="actualizarCantidad(${item.id}, 1)" class="bg-gray-300 px-2">+</button>
                            <button onclick="eliminarItem(${item.id})" class="text-red-600 ml-4">Eliminar</button>
                        </div>
                    </div>
                </div>
            `;
        });
    
        document.getElementById('subtotal').textContent = `$${subtotal.toLocaleString()}`;
        document.getElementById('total-items').textContent = totalItems;
    }
    
    function actualizarCantidad(itemId, delta) {
        fetch(`/api/carrito/actualizar/${itemId}`, {
            method: 'PUT',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
            body: JSON.stringify({ delta })
        })
        .then(response => response.json())
        .then(data => actualizarCarritoSidebar(data.carrito));
    }
    
    function eliminarItem(itemId) {
        fetch(`/api/carrito/eliminar/${itemId}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(response => response.json())
        .then(data => actualizarCarritoSidebar(data.carrito));
    }
    </script>
    
    @fluxScripts
</body>

</html>

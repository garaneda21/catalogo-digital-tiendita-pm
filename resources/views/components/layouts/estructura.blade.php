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
    @fluxScripts
</body>

</html>
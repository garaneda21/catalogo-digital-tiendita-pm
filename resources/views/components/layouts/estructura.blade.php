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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body>
    <header class="bg-[#f8e9d4]">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
            <a href="/"> <h1 class="text-2xl font-serif text-[#3D3C63]">Tiendita PM</h1> </a>
            <nav class="space-x-6 text-sm font-semibold">
                <a href="/" class=" text-[#D88C4B] hover:text-[#3D3C63]">Inicio</a>
                <a href="/perfumes" class="text-[#D88C4B] hover:text-[#3D3C63]">Catálogo</a>
                <a href="#nosotros" class="text-[#D88C4B] hover:text-[#3D3C63]">Nosotros</a>
                <a href="#contacto" class="text-[#D88C4B] hover:text-[#3D3C63]">Contacto</a>
            </nav>
        </div>
    </header>

    <div class="bg-[#fefef9] min-h-screen">
        {{ $slot }}
    </div>

    <footer id="contacto" class="bg-[#3D3C63] text-white py-12">
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
        <div class="text-center mt-8 text-sm text-[#E5B958]">© 2025 Tiendita PM. Todos los derechos reservados.</div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>

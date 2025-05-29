<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administracion</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white p-6 shadow-md min-h-screen fixed top-0 left-0">
            <h2 class="text-xl font-bold mb-6">Panel de Administración</h2>
            </h2>
            <nav class="flex flex-col space-y-4">
                <a href="/admin/productos/">
                    <button class="w-full text-left bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                        Todos los Productos
                    </button>
                </a>
                <a href="/admin/productos/create">
                    <button class="w-full text-left bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                        Crear Producto
                    </button>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-500 rounded hover:bg-gray-200 hover:cursor-pointer">
                        <x-iconos.salir />Cerrar sesión
                    </button>
                </form>
            </nav>


        </aside>

        <!-- Contenido Principal -->
        <main class="flex-1 p-6 ml-64 bg-gray-100 min-h-screen">
            {{ $slot }}
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
    <!-- Este script es para colocarle signo peso y puntos a los input precio -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('precio');

            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, ''); // Solo números
                if (value) {
                    value = new Intl.NumberFormat('es-CL').format(value);
                    e.target.value = '$' + value;
                } else {
                    e.target.value = '';
                }
            });
        });
    </script>
    <!-- script para el boton de cerrar sesión -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('userDropdownButton');
            const menu = document.getElementById('userDropdownMenu');
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });
            document.addEventListener('click', function(e) {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administracion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white p-6 shadow-md min-h-screen fixed top-0 left-0">
            <h2 class="text-xl font-bold mb-6">Panel de Administración</h2></h2>
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
            </nav>
        </aside>

        <!-- Contenido Principal -->
        <main class="flex-1 p-6 ml-64 bg-gray-100 min-h-screen">
            {{ $slot }}
        </main>
    </div>
</body>
</html>

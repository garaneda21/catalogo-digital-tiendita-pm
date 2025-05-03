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
                <a href="{{ route('panel', ['vista' => 'productos']) }}">
                    <button class="w-full text-left bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                        Todos los Productos
                    </button>
                </a>
                <a href="{{ route('panel', ['vista' => 'crear']) }}">
                    <button class="w-full text-left bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                        Crear Producto
                    </button>
                </a>
            </nav>
        </aside>

        <!-- Contenido Principal -->
        <main class="flex-1 p-6 ml-64 bg-gray-100 min-h-screen">
            @if ($vista == 'productos')
                <div class="flex justify-between items-center mb-6">
                    <input type="text" placeholder="Buscar..." class="border px-4 py-2 rounded w-1/2">
                    <button class="bg-gray-300 p-2 rounded hover:bg-gray-400">☰</button>
                </div>

                <div class="space-y-4">
                    @foreach (['producto 1', 'producto 2', 'producto 3'] as $producto)
                        <div class="bg-white shadow p-4 rounded flex justify-between items-center mb-4">
                            <span>{{ $producto }}</span>
                            <button class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                                Editar
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                <button class="px-4 py-2 border rounded bg-white hover:bg-gray-100">Anterior</button>
                    <button class="px-4 py-2 border rounded bg-white hover:bg-gray-100">Siguiente</button>
                </div>
            @elseif ($vista == 'crear')

            @endif
        </main>
    </div>
</body>
</html>
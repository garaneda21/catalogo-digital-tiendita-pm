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
                    <!-- Lo que vendria despues, cuando este la bd -->
                    <!-- es solo un ejemplo -->
                    {{-- 
                    <!--@foreach ($productos as $producto)
                        <div class="bg-white shadow p-4 rounded flex justify-between items-center mb-4">
                            <span>{{ $producto->nombre }}</span>
                            <button class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                                Editar
                            </button>
                        </div>
                    @endforeach -->
                    --}}

                </div>

                <div class="mt-6">
                <button class="px-4 py-2 border rounded bg-white hover:bg-gray-100">Anterior</button>
                    <button class="px-4 py-2 border rounded bg-white hover:bg-gray-100">Siguiente</button>
                </div>
            @elseif ($vista == 'crear')
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

                <form method="post" action="/producto">
                    @csrf

                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base/7 font-semibold text-gray-900">Nuevo Producto</h2>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                <!-- Nombre Producto -->
                                <div class="col-span-full">
                                    <label for="nombre_producto" class="block text-sm/6 font-medium text-gray-900">Nombre
                                            Producto <span class="text-sm text-gray-500">(requerido)</span></label>
                                    <div class="mt-2">
                                        <div
                                            class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                            <input type="text" name="nombre_producto" id="nombre_producto"
                                                class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6">
                                        </div>
                                    </div>
                                </div>

                                <!-- Categoría -->
                                <div class="col-span-full">
                                    <label for="categoria" class="block text-sm/6 font-medium text-gray-900">Categoría <span class="text-sm text-gray-500">(requerido)</span></label>
                                    <div class="mt-2 grid grid-cols-1">
                                        <select id="categoria" name="categoria"
                                            class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                            <option value="1">Perfumes</option>
                                            <option value="2">Ropa</option>
                                            <option value="3">Otro</option>
                                        </select>
                                        <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                            viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                            <path fill-rule="evenodd"
                                                d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Precio -->
                                <div class="col-span-full">
                                    <label for="precio" class="block text-sm/6 font-medium text-gray-900">Precio <span class="text-sm text-gray-500">(requerido)</span></label>
                                    <div class="mt-2">
                                        <div
                                            class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                            <input type="text" name="precio" id="precio"
                                                class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6">
                                        </div>
                                    </div>
                                </div>

                                <!-- Stock Actual -->
                                <div class="col-span-full">
                                    <label for="stock_actual" class="block text-sm/6 font-medium text-gray-900">Stock Actual</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                            <input type="number" name="stock_actual" id="stock_actual" min="0"
                                                class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6">
                                        </div>
                                    </div>
                                </div>

                                <!-- Descripción -->
                                <div class="col-span-full">
                                    <label for="descripcion" class="block text-sm/6 font-medium text-gray-900">Descripción</label>
                                    <div class="mt-2">
                                        <textarea name="descripcion" id="descripcion" rows="3"
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                                    </div>
                                </div>

                                @if ($errors->any())
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancelar</button>
                        <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar</button>
                    </div>
                </form>
                </div>
            @endif
        </main>
    </div>
</body>
</html>
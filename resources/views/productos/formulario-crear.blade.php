<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear Producto</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>

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
                            <label for="categoria" class="block text-sm/6 font-medium text-gray-900">Categoría <span
                                    class="text-sm text-gray-500">(requerido)</span></label>
                            <div class="mt-2 grid grid-cols-1">

                                <select id="categoria" name="categoria"
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">

                                    @foreach ($categorias->all() as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                                    @endforeach

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
                            <label for="precio" class="block text-sm/6 font-medium text-gray-900">Precio <span
                                    class="text-sm text-gray-500">(requerido)</span></label>
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
                            <label for="stock_actual" class="block text-sm/6 font-medium text-gray-900">Stock
                                Actual</label>
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
                            <label for="descripcion"
                                class="block text-sm/6 font-medium text-gray-900">Descripción</label>
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

</body>

</html>

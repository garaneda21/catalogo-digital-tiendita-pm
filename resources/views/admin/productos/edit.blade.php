<x-layouts.panel>

    <form method="POST" action="{{ route('productos.update', $producto->id) }}">
        @csrf
        @method('PUT')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Editar Producto</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="col-span-full">
                        <label for="nombre_producto" class="block text-sm/6 font-medium text-gray-900">
                            Nombre Producto <span class="text-sm text-gray-500">(requerido)</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" name="nombre_producto" id="nombre_producto"
                            value="{{ old('nombre_producto', $producto->nombre_producto) }}"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="categoria" class="block text-sm/6 font-medium text-gray-900">
                            Categoría <span class="text-sm text-gray-500">(requerido)"></span>
                        </label>
                        <div class="mt-2">
                            <select name="categoria_id" id="categoria" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></select>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

</x-layouts.panel>
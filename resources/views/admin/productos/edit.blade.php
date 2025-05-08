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
                            Categoría <span class="text-sm text-gray-500">(requerido)</span>
                        </label>
                        <div class="mt-2">
                            <select name="categoria" id="categoria" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre_categoria }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="precio" class="block text-sm/6 font-medium text-gray-900">
                            Precio <span class="text-sm text-gray-500">(requerido)</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" name="precio" id="precio" 
                            value="{{ old('precio', $producto->precio) }}" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="col-span-full">
                    <label for="stock_actual" class="block text-sm/6 font-medium text-gray-900">Stock Actual</label>
                        <div class="mt-2">
                            <input type="number" name="stock_actual" id="stock_actual" min="0" 
                            value="{{ old('stock_actual', $producto->stock_actual) }}"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="descripcion" class="block text-sm/6 font-medium text-gray-900">Descripción</label>
                        <div class="mt-2">
                            <textarea name="descripcion" id="descripcion" rows="3"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('descripcion', $producto->descripcion) }}</textarea>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="col-span-full mt-4 text-sm text-red-600">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('productos.index') }}" class="text-sm/6 font-semibold text-gray-900">Cancelar</a>
            <button type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Actualizar
            </button>
        </div>
    </form>

</x-layouts.panel>
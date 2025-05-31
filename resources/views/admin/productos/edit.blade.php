<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header="Editar producto">
        <flux:button href="/admin/productos" icon="arrow-left" class="dark:text-black! dark:bg-white! hover:bg-gray-200! rounded-3xl!">
            Volver
        </flux:button>
    </x-panel.header>

    <form method="POST" enctype="multipart/form-data" action="{{ route('productos.update', $producto->id) }}">
        @csrf
        @method('PUT')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">


                    <!-- Nombre Producto -->
                    <x-form-field>
                        <x-form-label for="nombre_producto">Nombre Producto
                            <span class="text-sm text-red-500">(requerido)</span>
                        </x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="nombre_producto" id="nombre_producto"
                                value="{{ $producto->nombre_producto }}"></x-form-input>
                        </div>
                    </x-form-field>

                    <!-- Categoría -->
                    <x-form-field>
                        <x-form-label for="categoria">Categoría
                            <span class="text-sm text-red-500">(requerido)</span>
                        </x-form-label>
                        <div class="mt-2">
                            <x-form-select id="categoria" name="categoria">
                                @foreach ($categorias->all() as $categoria)
                                    {{ $esta_seleccionado = $producto->categoria_id == $categoria->id ? true : false }}
                                    <option value="{{ $categoria->id }}" {{ $esta_seleccionado ? 'selected' : '' }}>
                                        {{ $categoria->nombre_categoria }}
                                        {{ $esta_seleccionado ? '(seleccionado)' : '' }}
                                    </option>
                                @endforeach
                            </x-form-select>
                        </div>
                    </x-form-field>

                    <!-- Precio -->
                    <x-form-field>
                        <x-form-label for="precio">Precio
                            <span class="text-sm text-red-500">(requerido)</span>
                        </x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="precio" id="precio"
                                value="{{ '$' . number_format($producto->precio, 0, ',', '.') }}"></x-form-input>
                        </div>
                    </x-form-field>

                    <!-- Stock Actual -->
                    <x-form-field>
                        <x-form-label for="stock_actual">Stock Actual <span
                                class="text-red-500">(requerido)</span></x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="stock_actual" id="stock_actual"
                                value="{{ number_format($producto->stock_actual, 0, ',', '.') }}"></x-form-input>
                        </div>
                    </x-form-field>


                    <!-- Descripción -->
                    <x-form-field>
                        <x-form-label for="descripcion">Descripción</x-form-label>
                        <div class="mt-2">
                            <x-form-textarea name="descripcion" id="descripcion"
                                rows="3">{{ $producto->descripcion }}</x-form-textarea>
                        </div>
                    </x-form-field>

                    <!-- Imagen -->
                    <x-form-field>
                        <x-form-label for="imagen">Imagen del producto</x-form-label>

                        <div class="mt-2">
                            <x-form-input-image :imagen_actual="$producto->imagen_url" />
                        </div>
                    </x-form-field>

                    @if ($errors->any())
                        <x-form-errorcard />
                    @endif
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="{{ route('productos.index') }}" class="text-sm/6 font-semibold text-gray-900">Cancelar</a>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Actualizar
                </button>
            </div>
        </div>

    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ------- Formateo del precio -------
            const precioInput = document.getElementById('precio');
        
            precioInput?.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 9) {
                    value = value.substring(0, 9);
                }
                e.target.value = value ? '$' + new Intl.NumberFormat('es-CL').format(value) : '';
            });
        
            // ------- Formateo del stock_actual -------
            const stockInput = document.getElementById('stock_actual');
        
            stockInput?.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 9) {
                    value = value.substring(0, 9);
                }
                e.target.value = value ? new Intl.NumberFormat('es-CL').format(value) : '';
            });
        });
    </script>


</x-layouts.app>

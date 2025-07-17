<x-layouts.navlist-productos :producto="$producto">

    <h2 class="mb-4 text-2xl text-azul-profundo font-bold">Editar Datos</h2>

    <form method="POST" enctype="multipart/form-data" action="{{ route('productos.update', $producto->id) }}">
        @csrf
        @method('PUT')

        <div class="flex flex-col gap-6 max-w-lg">
            <p class="text-melocoton">Edita los campos que quieras modificar</p>

            <!-- Nombre Producto -->
            <flux:input name="nombre_producto" label="Nombre Producto (*)" type="text" autofocus
                value="{{ $producto->nombre_producto }}" />

            <!-- Categoría -->
            <flux:select name="categoria" label="Categoría (*)">
                <option value="">Sin categoría</option>

                @foreach ($categorias->all() as $categoria)
                    {{ $esta_seleccionado = $producto->categoria_id == $categoria->id ? true : false }}
                    <option value="{{ $categoria->id }}" {{ $esta_seleccionado ? 'selected' : '' }}>
                        {{ $categoria->nombre_categoria }}
                        {{ $esta_seleccionado ? '(seleccionado)' : '' }}
                    </option>
                @endforeach
            </flux:select>

            <!-- Precio -->
            <flux:input name="precio" id="precio" label="Precio (*)" type="text"
                value="{{ '$' . number_format($producto->precio, 0, ',', '.') }}" />

            <!-- Stock Actual -->
            <flux:input name="stock_actual" id="stock_actual" label="Stock Actual (*)" type="text"
                value="{{ number_format($producto->stock_actual, 0, ',', '.') }}" />

            <!-- Producto destacado -->
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="destacado" id="destacado" value="1"
                    {{ $producto->destacado ? 'checked' : '' }}
                    class="w-4 h-4 text-verde-oliva border-gray-300 rounded focus:ring-verde-oliva">
                <label for="destacado" class="text-sm font-semibold text-azul-profundo">Marcar como producto destacado</label>
            </div>

            <!-- Descripción -->
            <flux:textarea label="Descripción del Producto" name="descripcion" id="descripcion">
                {{ $producto->descripcion }}
            </flux:textarea>

            <x-forms.input-imagen :imagen_actual="$producto->imagen_url" />

            @if ($errors->any())
                <x-forms.error-card></x-forms.error-card>
            @endif

            <hr>

            <div class="flex items-center justify-end gap-x-6">
                <flux:button type="submit" variant="primary" icon="arrow-path"
                    class="bg-verde-oliva hover:bg-verde-oliva/70! dark:text-black! dark:bg-white! rounded-3xl!">
                    Actualizar
                </flux:button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ------- Formateo del precio -------
            const precioInput = document.getElementById('precio');

            precioInput?.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 9) {
                    value = value.substring(0, 9);
                }
                e.target.value = value ? '$' + new Intl.NumberFormat('es-CL').format(value) : '';
            });

            // ------- Formateo del stock_actual -------
            const stockInput = document.getElementById('stock_actual');

            stockInput?.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 9) {
                    value = value.substring(0, 9);
                }
                e.target.value = value ? new Intl.NumberFormat('es-CL').format(value) : '';
            });
        });
    </script>


</x-layouts.navlist-productos>

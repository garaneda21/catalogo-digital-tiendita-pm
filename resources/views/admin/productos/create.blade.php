<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header="Crear nuevo producto">
        <flux:button href="/admin/productos" icon="arrow-left"
            class="dark:text-black! dark:bg-white! hover:bg-gray-200! rounded-3xl!">
            Volver
        </flux:button>
    </x-panel.header>

    <form method="post" enctype="multipart/form-data" action="/admin/productos">
        @csrf
        <div class="flex flex-col gap-6 max-w-lg mt-6">
            <p class="text-melocoton">Rellena los datos para crear tu nuevo producto</p>

            <!-- Nombre Producto -->
            <flux:input name="nombre_producto" label="Nombre Producto (*)" type="text" autofocus
                :value="old('nombre_producto')" />

            <!-- Categoría -->
            <flux:select name="categoria" label="Categoría (*)">
                @foreach ($categorias->all() as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre_categoria }}
                    </option>
                @endforeach
            </flux:select>

            <!-- Precio -->
            <flux:input name="precio" id="precio" label="Precio (*)" type="text" autofocus
                :value="old('precio')" />

            <!-- Stock Actual -->
            <flux:input name="stock_actual" id="stock_actual" label="Stock Actual (*)" type="text" autofocus
                :value="old('stock_actual')" />

            <!-- Descripción -->
            <flux:textarea label="Descripción del Producto" name="descripcion" id="descripcion" >
                {{ old('descripcion') }}
            </flux:textarea>

            <x-forms.input-imagen/>

            @if ($errors->any())
                <x-forms.error-card></x-forms.error-card>
            @endif

            <hr>

            <div class="flex items-center justify-end gap-x-6">
                <flux:button type="submit" variant="primary" icon="squares-plus"
                    class="bg-verde-oliva hover:bg-verde-oliva/70! dark:text-black! dark:bg-white! rounded-3xl!">
                    Crear Producto
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


</x-layouts.app>

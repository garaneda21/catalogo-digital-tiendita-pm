<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header='Registrar venta del producto "{{ $producto->nombre_producto }}"'>
        <flux:button href="/admin/productos" icon="arrow-left"
            class="dark:text-black! dark:bg-white! hover:bg-gray-200! rounded-3xl!">
            Volver
        </flux:button>
    </x-panel.header>

    <form method="post" action="/admin/movimientos/salida/{{ $producto->id }}">
        @csrf
        <div class="flex flex-col gap-6 max-w-lg mt-6">
            <p class="text-melocoton">Rellena los datos para crear tu nuevo producto</p>


            <!-- Cantidad -->
            <flux:input name="cantidad" id="cantidad" label="Cantidad Vendida (*)" type="text" autofocus
                :value="old('cantidad')" />

            <!-- Motivo -->
            <flux:select name="motivo" label="Motivo (*)">
                @foreach ($motivos->all() as $motivo)
                    <option value="{{ $motivo->id }}" {{ old('motivo') == $motivo->id ? 'selected' : '' }}>
                        {{ $motivo->nombre_motivo }}
                    </option>
                @endforeach
            </flux:select>

            @if ($errors->any())
                <x-forms.error-card></x-forms.error-card>
            @endif

            <hr>

            <div class="flex items-center justify-end gap-x-6">
                <flux:button type="submit" variant="primary" icon="check-circle"
                    class="bg-verde-oliva hover:bg-verde-oliva/70! dark:text-black! dark:bg-white! rounded-3xl!">
                    Confirmar Venta
                </flux:button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ------- Formateo del la cantidad-------
            const stockInput = document.getElementById('cantidad');

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

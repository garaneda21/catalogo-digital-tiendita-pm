<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header='Registrar ingreso de stock para "{{ $producto->nombre_producto }}"'>
        <flux:button href="/admin/productos" icon="arrow-left"
            class="dark:text-black! dark:bg-white! hover:bg-gray-200! rounded-3xl!">
            Volver
        </flux:button>
    </x-panel.header>

    <form method="post" action="/admin/movimientos/entrada/{{ $producto->id }}" id="FormularioStock">
        @csrf
        <div class="flex flex-col gap-6 max-w-lg mt-6">
            <p class="text-melocoton">Rellena los datos para registrar el ingreso de stock</p>


            <flux:input name="cantidad" id="cantidad" label="Cantidad Ingresada (*)" type="text" autofocus :value="old('cantidad')" />

            <!-- Motivo de movimiento -->
            <flux:select name="motivo" label="Motivo de Ingreso (*)">
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
                <flux:button type="submit" variant="primary" icon="plus-circle"
                    class="bg-verde-oliva hover:bg-verde-oliva/70! dark:text-black! dark:bg-white! rounded-3xl!">
                    Confirmar Ingreso
                </flux:button>
            </div>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const stockInput = document.getElementById('cantidad');
                const formulario = document.getElementById('FormularioStock');

                stockInput?.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length > 9) {
                        value = value.substring(0, 9);
                    }
                    e.target.value = value ? new Intl.NumberFormat('es-CL').format(value) : '';
                });

                formulario?.addEventListener('submit', function () {
                    if (stockInput) {
                        stockInput.value = stockInput.value.replace(/\./g, '').replace(/\./g, '');
                    }
                });
            });
        </script>
</x-layouts.app>

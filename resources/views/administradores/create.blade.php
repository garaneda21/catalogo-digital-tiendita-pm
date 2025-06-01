<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header="Crear un nuevo administrador">
        <flux:button href="/admin/administradores" icon="arrow-left"
            class="dark:text-black! dark:bg-white! hover:bg-gray-200! rounded-3xl!">
            Volver
        </flux:button>
    </x-panel.header>

    <form method="post" action="/admin/administradores">
        @csrf
        <div class="flex flex-col gap-6 max-w-lg mt-6">
            <p class="text-melocoton">Rellena los datos para registrar a un nuevo administrador</p>

            <!-- Nombre -->
            <flux:input name="nombre_admin" label="Nombre del administrador" type="text" autofocus placeholder="Nombre completo" :value="old('nombre_admin')"/>

            <!-- Correo -->
            <flux:input name="correo_admin" label="Correo" type="email" placeholder="email@ejemplo.com" :value="old('correo_admin')"/>

            <!-- Contraseña -->
            <flux:input name="password" label="Contraseña" type="password" autocomplete="new-password" viewable />

            <flux:input name="password_confirmation" label="Confirmar contraseña" type="password" autocomplete="new-password" viewable />

            <hr>

            @if ($errors->any())
                <x-form-errorcard></x-form-errorcard>
            @endif

            <div class="flex items-center justify-end gap-x-6">
                <flux:button type="submit" variant="primary" icon="user-plus"
                    class="bg-verde-oliva hover:bg-verde-oliva/70! dark:text-black! dark:bg-white! rounded-3xl!">
                    Crear Administrador
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

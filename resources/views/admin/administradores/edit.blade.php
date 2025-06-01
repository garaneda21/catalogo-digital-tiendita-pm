<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header='Modificar datos de "{{ $admin->nombre_admin }}"'>
        <flux:button href="/admin/productos" icon="arrow-left"
            class="dark:text-black! dark:bg-white! hover:bg-gray-200! rounded-3xl!">
            Volver
        </flux:button>
    </x-panel.header>

    <form method="POST" action="{{ route('administradores.update', $admin->id) }}">
        @csrf
        @method('PUT')

        <div class="flex flex-col gap-6 max-w-lg mt-6">
            <!-- Nombre -->
            <flux:input name="nombre_admin" label="Nombre del administrador" type="text" autofocus
                placeholder="Nombre completo" value="{{ $admin->nombre_admin }}" />

            <!-- Correo -->
            <flux:input name="correo_admin" label="Correo" type="email" placeholder="email@ejemplo.com"
                value="{{ $admin->correo_admin }}" />

            <hr>

            @if ($errors->any())
                <x-form-errorcard></x-form-errorcard>
            @endif

            <div class="flex items-center justify-end gap-x-6">
                <flux:button type="submit" variant="primary" icon="user-plus"
                    class="bg-verde-oliva hover:bg-verde-oliva/70! dark:text-black! dark:bg-white! rounded-3xl!">Editar</flux:button>
            </div>
        </div>
    </form>
</x-layouts.app>

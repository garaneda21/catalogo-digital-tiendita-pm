<x-layouts.app :title="__('Dashboard')">
    <x-panel.header nombre_header="{{ $admin->nombre_admin }}">
        <flux:button href="/admin/administradores" icon="arrow-left"
            class="dark:text-black! dark:bg-white! hover:bg-gray-200! rounded-3xl!">
            Volver
        </flux:button>
    </x-panel.header>

    <div class="mt-4 flex items-start max-md:flex-col">
        <div class="me-10 w-full pb-4 md:w-[220px]">
            <flux:navlist.group>
                <flux:navlist.item href="/admin/administradores/{{ $admin->id }}" class="data-current:bg-gray-200!">Detalles</flux:navlist.item>
                <flux:navlist.item href="/admin/administradores/{{ $admin->id }}/edit" class="data-current:bg-gray-200!">Editar Datos</flux:navlist.item>
                <flux:navlist.item href="/admin/administradores/" class="data-current:bg-gray-200!">Editar Permisos </flux:navlist.item>
                <flux:navlist.item href="/admin/administradores/" class="data-current:bg-gray-200!">Cambiar Contraseña </flux:navlist.item>
                <flux:navlist.item href="/admin/administradores/" class="data-current:bg-gray-200!">Historial</flux:navlist.item>
                <flux:navlist.item href="/admin/administradores/" class="data-current:bg-gray-200!">Desactivar Admin</flux:navlist.item>
            </flux:navlist.group>
        </div>

        <flux:separator class="md:hidden" />

        <div class="flex-1 self-stretch max-md:pt-6">
            {{ $slot }}
        </div>
    </div>
</x-layouts.app>

<x-layouts.app :title="__('Dashboard')">
    <x-panel.header nombre_header="{{ $usuario->nombre_usuario }}">
        <flux:button href="/admin/usuarios" icon="arrow-left"
            class="dark:text-black! dark:bg-white! hover:bg-gray-200! rounded-3xl!">
            Volver
        </flux:button>
    </x-panel.header>

    <div class="mt-4 flex items-start max-md:flex-col">
        <div class="me-10 w-full pb-4 md:w-[220px]">
            <flux:navlist.group>
                <flux:navlist.item href="/admin/usuarios/{{ $usuario->id }}" class="data-current:bg-gray-200! hover:underline!">Detalles</flux:navlist.item>
                <flux:navlist.item href="/admin/usuarios/{{ $usuario->id }}/edit" class="data-current:bg-gray-200! hover:underline!">Editar Datos</flux:navlist.item>
                <!-- <flux:navlist.item href="#" class="data-current:bg-gray-200! hover:underline!">Editar Permisos </flux:navlist.item> -->
                <!-- <flux:navlist.item href="#" class="data-current:bg-gray-200! hover:underline!">Cambiar Contraseña </flux:navlist.item> -->
                <!-- <flux:navlist.item href="/admin/usuarios/{{ $usuario->id }}/historial" class="data-current:bg-gray-200! hover:underline!">Historial</flux:navlist.item> -->
                <!-- <flux:navlist.item href="#" class="data-current:bg-gray-200! hover:underline!">Desactivar Usuario</flux:navlist.item> -->
            </flux:navlist.group>
        </div>

        <flux:separator class="md:hidden" />

        <div class="flex-1 self-stretch max-md:pt-6">
            {{ $slot }}
        </div>
    </div>
</x-layouts.app>

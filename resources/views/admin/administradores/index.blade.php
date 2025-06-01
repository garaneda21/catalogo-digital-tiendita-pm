<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header="Administradores">
        <flux:button href="/admin/administradores/create" icon="plus" variant="primary"
            class="text-white bg-verde-oliva rounded-3xl! hover:bg-verde-oliva/70">
            Nuevo Administrador
        </flux:button>
    </x-panel.header>

    <div class="py-4 space-y-2 mx-auto">

        <div class="overflow-hidden rounded-lg shadow">
            <table class="min-w-full border-separate border-spacing-0 text-sm">
                <thead class="bg-gray-200 text-azul-profundo">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Correo</th>
                        <th class="px-4 py-2 text-left">Creación</th>
                        <th class="px-4 py-2 text-right">Acciones Rápidas</th>
                    </tr>
                </thead>
                @foreach ($administradores as $admin)
                <tbody class="bg-white text-[#3D3C63]">
                    <tr class="hover:bg-[#FAFAFA]">
                        <td class="px-4 py-2">{{ $admin->id }}</td>
                        <td class="px-4 py-2">{{ $admin->nombre_admin }}</td>
                        <td class="px-4 py-2">{{ $admin->correo_admin }}</td>
                        <td class="px-4 py-2">{{ $admin->created_at }}</td>
                        <td class="px-4 py-2 text-right space-x-2">
                            <flux:button href="{{ route('administradores.show', $admin->id) }}" tooltip="Detalles" icon="list-bullet" class="text-blue-600!"></flux:button>
                            <flux:button href="{{ route('administradores.edit', $admin->id) }}" tooltip="Editar Datos" icon="pencil-square" class="text-blue-600!"></flux:button>
                            <flux:button href="{{ route('administradores.edit', $admin->id) }}" tooltip="Editar Permisos" icon="key" class="text-blue-600!"></flux:button>
                            <flux:button tooltip="Historial de acciones" icon="clock" class="text-blue-600!"></flux:button>
                            <flux:button tooltip="Desactivar Admin" icon="eye-slash" class="text-red-600!"></flux:button>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>



</x-layouts.app>

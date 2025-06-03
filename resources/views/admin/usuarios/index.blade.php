<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header="Usuarios">
        <flux:button href="/admin/usuarios/create" icon="plus" variant="primary"
            class="text-white bg-verde-oliva rounded-3xl! hover:bg-verde-oliva/70">
            Nuevo Usuario
        </flux:button>
    </x-panel.header>

    <div class="py-4 space-y-2 mx-auto">

        <div class="overflow-hidden rounded-lg border-1">
            <table class="min-w-full border-separate border-spacing-0 text-sm">
                <thead class="bg-gray-200 text-azul-profundo">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Correo</th>
                        <th class="px-4 py-2 text-left">Último Cambio</th>
                        <th class="px-4 py-2 text-left">Creación</th>
                        <th class="px-4 py-2 text-left">Activo</th>
                        <th class="px-4 py-2 text-right">Acciones Rápidas</th>
                    </tr>
                </thead>
                @foreach ($usuarios as $usuario)
                <tbody class="bg-white text-[#3D3C63]">
                    <tr class="hover:bg-[#FAFAFA]">
                        <td class="px-4 py-2">{{ $usuario->id }}</td>
                        <td class="px-4 py-2">{{ $usuario->nombre_usuario }}</td>
                        <td class="px-4 py-2">{{ $usuario->correo_usuario }}</td>
                        <td class="px-4 py-2">{{ $usuario->ultimo_cambio ?? 'No ha hecho cambios aún' }}</td>
                        <td class="px-4 py-2">{{ $usuario->created_at }}</td>
                        <td class="px-4 py-2 text-right space-x-2">
                            <flux:button href="{{ route('usuarios.show', $usuario->id) }}" tooltip="Detalles" icon="list-bullet" class="text-blue-600!"></flux:button>
                            <flux:button href="{{ route('usuarios.edit', $usuario->id) }}" tooltip="Editar Datos" icon="pencil-square" class="text-blue-600!"></flux:button>
                            <flux:button tooltip="Desactivar Usuario" icon="eye-slash" class="text-red-600!"></flux:button>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>



</x-layouts.app>

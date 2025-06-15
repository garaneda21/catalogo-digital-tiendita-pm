<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header="Administradores">
        @can('create', App\Models\Administrador::class)
            <flux:button href="/admin/administradores/create" icon="plus" variant="primary"
                class="text-white bg-verde-oliva rounded-3xl! hover:bg-verde-oliva/70">
                Nuevo Administrador
            </flux:button>
        @else
            <flux:button disabled icon="plus" variant="primary"
                class="text-white bg-verde-oliva rounded-3xl! hover:bg-verde-oliva/70">
                Nuevo Administrador
            </flux:button>
        @endcan
    </x-panel.header>

    @can('viewAny', App\Models\Administrador::class)
        <div class="py-4 space-y-2 mx-auto">

            @if (session('success'))
                <x-mensaje-accion icon="check-circle" variant="success" heading="{{ session('success') }}" />
            @endif

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
                    @foreach ($administradores as $admin)
                        <tbody class="bg-white text-[#3D3C63]">
                            <tr class="hover:bg-[#FAFAFA]">
                                <td class="px-4 py-2">{{ $admin->id }}</td>
                                <td class="px-4 py-2">{{ $admin->nombre_admin }}</td>
                                <td class="px-4 py-2">{{ $admin->correo_admin }}</td>
                                <td class="px-4 py-2">{{ $admin->ultimo_cambio ?? 'No ha hecho cambios aún' }}</td>
                                <td class="px-4 py-2">{{ $admin->created_at }}</td>
                                <td class="px-4 py-2">{{ $admin->activo ? 'Si' : 'No' }}</td>
                                <td class="px-4 py-2 text-right space-x-2">
                                    <flux:button href="{{ route('administradores.show', $admin->id) }}" tooltip="Detalles"
                                        icon="list-bullet" class="text-blue-600!" />

                                    @can('update', App\Models\Administrador::class)
                                        <flux:button href="{{ route('administradores.edit', $admin->id) }}"
                                            tooltip="Editar Datos" icon="pencil-square" class="text-blue-600!" />
                                    @endcan
                                    @can('disable', App\Models\Administrador::class)
                                        <flux:button tooltip="Desactivar Admin" icon="eye-slash" class="text-red-600!" />
                                    @endcan
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    @else
        <div class="flex items-center justify-center h-64">
            <div class="text-center">
                <p class="text-lg font-semibold text-gray-600">No tienes permiso para ver los administradores.</p>
            </div>
        </div>
    @endcan
</x-layouts.app>

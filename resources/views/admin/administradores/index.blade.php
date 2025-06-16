<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header="Administradores">
        @can('create', App\Models\Administrador::class)
            <flux:button href="/admin/administradores/create" icon="plus" variant="primary"
                class="text-white bg-verde-oliva rounded-3xl! hover:bg-verde-oliva/70">
                Nuevo Administrador
            </flux:button>
        @else
            <flux:tooltip content="No tienes permiso para realizar esta acción">
                <div>
                    <flux:button disabled icon="plus" class="text-black rounded-3xl! hover:bg-verde-oliva/70">
                        Nuevo Administrador
                    </flux:button>
                </div>
            </flux:tooltip>
        @endcan
    </x-panel.header>

    @can('viewAny', App\Models\Administrador::class)
        <div class="py-4 space-y-2 mx-auto">

            @if (session('success'))
                <x-mensaje-accion icon="check-circle" variant="success" heading="{{ session('success') }}" />
            @endif

            <div class="overflow-auto rounded-lg border hidden md:block">
                <table class="w-full">
                    <thead class="bg-gray-200 text-azul-profundo">
                        <tr>
                            <th class="p-2 font-semibold tracking-wide text-left">ID</th>
                            <th class="p-2 font-semibold tracking-wide text-left">Nombre</th>
                            <th class="p-2 font-semibold tracking-wide text-left">Correo</th>
                            <th class="p-2 font-semibold tracking-wide text-left">Último Cambio</th>
                            <th class="p-2 font-semibold tracking-wide text-left">Creación</th>
                            <th class="p-2 font-semibold tracking-wide text-left">Activo</th>
                            <th class="p-2 font-semibold tracking-wide text-left">Super Admin</th>
                            <th class="p-2 font-semibold tracking-wide text-right">Acciones Rápidas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($administradores as $admin)
                            <tr class="odd:bg-white even:bg-gray-100">
                                <td class="p-3 text-gray-700 font-bold whitespace-nowrap">#{{ $admin->id }}</td>
                                <td class="p-3 text-gray-700 whitespace-nowrap">{{ $admin->nombre_admin }}</td>
                                <td class="p-3 text-gray-700 whitespace-nowrap">{{ $admin->correo_admin }}</td>
                                <td class="p-3 text-gray-700 whitespace-nowrap">
                                    {{ $admin->ultimo_cambio ?? 'No ha hecho cambios aún' }}</td>
                                <td class="p-3 text-gray-700 whitespace-nowrap">{{ $admin->created_at }}</td>
                                <td class="p-3 text-gray-700 whitespace-nowrap">{{ $admin->activo ? 'Si' : 'No' }}</td>
                                <td class="p-3 text-gray-700 whitespace-nowrap">{{ $admin->superadmin ? 'Si' : 'No' }}</td>
                                <td class="p-3 text-gray-700 whitespace-nowrap text-right space-x-2">
                                    <flux:button href="{{ route('administradores.show', $admin->id) }}" tooltip="Detalles"
                                        icon="list-bullet" class="text-blue-600!" />

                                    @can('update', App\Models\Administrador::class)
                                        <flux:button href="{{ route('administradores.edit', $admin->id) }}"
                                            tooltip="Editar Datos" icon="pencil-square" class="text-blue-600!" />
                                    @endcan
                                    @can('view', App\Models\Administrador::class)
                                        <flux:button href="{{ route('administradores.historial', $admin->id) }}"
                                            tooltip="Historial de Acciones" icon="clock" class="text-blue-600!" />
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Tarjetas para pantallas móviles -->
            <div class="grid grid-cols-1 gap-4 md:hidden">
                @foreach ($administradores as $admin)
                    <div class="bg-gray-50 border rounded-xl p-4 space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="font-sans! text-lg font-semibold text-gray-800">#{{ $admin->id }} -
                                    {{ $admin->nombre_admin }}</h2>
                                <p class="text-sm text-gray-500">{{ $admin->correo_admin }}</p>
                            </div>
                        </div>

                        <div class="space-x-2">
                            <span
                                class="px-2 py-1 text-sm rounded-full {{ $admin->activo ? 'bg-green-200 text-green-800' : 'bg-red-100 text-red-600' }}">
                                {{ $admin->activo ? 'Activo' : 'Inactivo' }}
                            </span>
                            @if ($admin->superadmin)
                                <span class="px-2 py-1 text-sm rounded-full bg-amber-200 text-amber-800">SuperAdmin </span>
                            @endif
                        </div>

                        <div class="text-sm text-gray-600 space-y-1">
                            <div><span class="font-medium">Creado:</span> {{ $admin->created_at }}</div>
                            <div><span class="font-medium">Último cambio:</span>
                                {{ $admin->ultimo_cambio ?? 'No ha hecho cambios aún' }}</div>
                        </div>

                        <div class="flex justify-end items-center space-x-2 pt-2">
                            <span class="text-gray-700 font-bold">Acciones Rápidas: </span>
                            <flux:button href="{{ route('administradores.show', $admin->id) }}" tooltip="Detalles"
                                icon="list-bullet" class="text-blue-600!" />

                            @can('update', App\Models\Administrador::class)
                                <flux:button href="{{ route('administradores.edit', $admin->id) }}" tooltip="Editar Datos"
                                    icon="pencil-square" class="text-blue-600!" />
                            @endcan

                            @can('disable', App\Models\Administrador::class)
                                <flux:button tooltip="Desactivar Admin" icon="eye-slash" class="text-red-600!" />
                            @endcan
                        </div>
                    </div>
                @endforeach
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

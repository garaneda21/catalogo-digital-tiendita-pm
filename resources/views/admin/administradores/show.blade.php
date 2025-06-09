<x-layouts.navlist-show-admins :admin="$admin">

    <h2 class="mb-4 text-2xl text-azul-profundo font-bold">Detalles</h2>

    @can('view', App\Models\Administrador::class)
        <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-azul-profundo">
            <div class="bg-gray-50 rounded-lg p-4 border-1">
                <p class="text-gray-500 mb-1">Nombre</p>
                <p class="font-medium">{{ $admin->nombre_admin }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 border-1">
                <p class="text-gray-500 mb-1">Correo electrónico</p>
                <p class="font-medium">{{ $admin->correo_admin }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 border-1">
                <p class="text-gray-500 mb-1">Fecha de creación</p>
                <p class="font-medium">{{ $admin->created_at }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 border-1">
                <p class="text-gray-500 mb-1">Último acceso</p>
                <p class="font-medium">{{ $admin->ultimo_login }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 border-1">
                <p class="text-gray-500 mb-1">Estado</p>
                @if ($admin->activo)
                    <p class="font-medium text-green-600">Activo</p>
                @else
                    <p class="font-medium text-red-600">Inactivo</p>
                @endif
            </div>
        </div>

        <h2 class="mb-4 text-2xl text-azul-profundo font-bold">Permisos Actuales</h2>

        <h2 class="mb-4 text-2xl text-azul-profundo font-bold">Ultimas acciones</h2>

        <div class="mt-4 overflow-hidden rounded-lg border-1">
            <table class="min-w-full border-separate border-spacing-0 text-sm">
                <thead class="bg-gray-200 text-azul-profundo">
                    <tr>
                        <th class="px-4 py-2 text-left">Acción</th>
                        <th class="px-4 py-2 text-left">Entidad Modificada</th>
                        <th class="px-4 py-2 text-left">Datos</th>
                        <th class="px-4 py-2 text-left">Fecha Registro</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-[#3D3C63]">
                    @foreach ($registros as $registro)
                        <tr class="hover:bg-[#FAFAFA]">
                            <td class="px-4 py-2">{{ $registro->accion->nombre_accion }}</td>
                            <td class="px-4 py-2">{{ $registro->entidad_modificada ?? '---' }}</td>
                            <td class="px-4 py-2">{{ $registro->id_entidad_modificada ?? '---' }}</td>
                            <td class="px-4 py-2">{{ $registro->fecha_registro }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="flex items-center justify-center h-64">
            <div class="text-center">
                <p class="text-lg font-semibold text-gray-600">No tienes permiso para ver los detalles de un administrador.</p>
            </div>
        </div>
    @endcan
</x-layouts.navlist-show-admins>

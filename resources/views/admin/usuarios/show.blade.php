<x-layouts.navlist-show-users :usuario="$usuario">

    <h2 class="mb-4 text-2xl text-azul-profundo font-bold">Detalles</h2>

    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-azul-profundo">
        <div class="bg-gray-50 rounded-lg p-4 border-1">
            <p class="text-gray-500 mb-1">Nombre</p>
            <p class="font-medium">{{ $usuario->name }}</p>
        </div>
        <div class="bg-gray-50 rounded-lg p-4 border-1">
            <p class="text-gray-500 mb-1">Correo electrónico</p>
            <p class="font-medium">{{ $usuario->email }}</p>
        </div>
        <div class="bg-gray-50 rounded-lg p-4 border-1">
            <p class="text-gray-500 mb-1">Fecha de creación</p>
            <p class="font-medium">{{ $usuario->created_at }}</p>
        </div>
        <div class="bg-gray-50 rounded-lg p-4 border-1">
            <p class="text-gray-500 mb-1">Último acceso</p>
            <p class="font-medium">{{ $usuario->ultimo_login ?? '---' }}</p>
        </div>
    </div>

    <h2 class="mb-4 text-2xl text-azul-profundo font-bold">Permisos Actuales</h2>
    {{-- Aquí puedes agregar la sección de permisos si aplica para usuarios --}}

    <h2 class="mb-4 text-2xl text-azul-profundo font-bold">Últimas acciones</h2>

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
                        <td class="px-4 py-2">{{ $registro->entidad_modificada ?? '---'}}</td>
                        <td class="px-4 py-2">{{ $registro->id_entidad_modificada ?? '---' }}</td>
                        <td class="px-4 py-2">{{ $registro->fecha_registro }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layouts.navlist-show-users>

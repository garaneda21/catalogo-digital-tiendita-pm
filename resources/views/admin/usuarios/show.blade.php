<x-layouts.navlist-show-users :usuario="$usuario">

    <h2 class="mb-4 text-2xl text-azul-profundo font-bold">Detalles</h2>

    @cannot('view', App\Models\User::class)
        <div class="flex items-center justify-center h-64">
            <div class="text-center">
                <p class="text-lg font-semibold text-gray-600">
                    No tienes permiso para ver los detalles de un administrador.
                </p>
            </div>
        </div>
    @else
        <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4 text-azul-profundo">
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
    @endcannot
</x-layouts.navlist-show-users>

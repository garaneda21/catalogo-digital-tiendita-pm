<x-layouts.navlist-show-admins :admin="$admin">

    <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-azul-profundo">
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
            <p class="font-medium">31 de mayo, 2025 - 10:43 AM</p>
        </div>
        <div class="bg-gray-50 rounded-lg p-4 border-1">
            <p class="text-gray-500 mb-1">Estado</p>
            <p class="font-medium text-green-600">Activo</p>
        </div>
    </div>

    <h2 class="text-xl text-azul-profundo font-bold">Ultimas acciones</h2>

    <div class="mt-4 overflow-hidden rounded-lg shadow">
        <table class="min-w-full border-separate border-spacing-0 text-sm">
            <thead class="bg-gray-200 text-azul-profundo">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-left">Correo</th>
                    <th class="px-4 py-2 text-left">Creación</th>
                    <th class="px-4 py-2 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white text-[#3D3C63]">
                <tr class="hover:bg-[#FAFAFA]">
                    <td class="px-4 py-2"></td>
                    <td class="px-4 py-2"></td>
                    <td class="px-4 py-2"></td>
                    <td class="px-4 py-2"></td>
                    <td class="px-4 py-2 text-right space-x-2">
                        <flux:button href="" tooltip="Detalles" icon="list-bullet" class="text-blue-600!">
                        </flux:button>
                        <flux:button tooltip="Historial de acciones" icon="clock" class="text-blue-600!">
                        </flux:button>
                        <flux:button href="" tooltip="Editar admin" icon="pencil-square" class="text-blue-600!">
                        </flux:button>
                        <flux:button tooltip="Eliminar admin" icon="trash" class="text-red-600!">
                        </flux:button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</x-layouts.navlist-show-admins>

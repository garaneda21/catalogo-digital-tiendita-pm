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
                        <th class="px-4 py-2 text-right">Acciones Rápidas</th>
                    </tr>
                </thead>
                @foreach ($usuarios as $usuario)
                <tbody class="bg-white text-[#3D3C63]">
                    <tr class="hover:bg-[#FAFAFA]">
                        <td class="px-4 py-2">{{ $usuario->id }}</td>
                        <td class="px-4 py-2">{{ $usuario->name }}</td>
                        <td class="px-4 py-2">{{ $usuario->email }}</td>
                        <td class="px-4 py-2">{{ $usuario->ultimo_cambio ?? 'No ha hecho cambios aún' }}</td>
                        <td class="px-4 py-2">{{ $usuario->created_at }}</td>
                        <td class="px-4 py-2 text-right space-x-2">
                            <flux:button href="{{ route('usuarios.show', $usuario->id) }}" tooltip="Detalles" icon="list-bullet" class="text-blue-600!"></flux:button>
                            <flux:button href="{{ route('usuarios.edit', $usuario->id) }}" tooltip="Editar Datos" icon="pencil-square" class="text-blue-600!"></flux:button>
                            <flux:modal.trigger name="eliminarUsuarioModal" onclick="prepararEliminacion({{ $usuario->id }})" class="text-red-600!">
                                <flux:button tooltip="Eliminar cuenta" icon="trash" class="text-red-600!"></flux:button>
                            </flux:modal.trigger>

                        </td>
                    </tr>
                </tbody>
                @endforeach
                <flux:modal name="eliminarUsuarioModal" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
                    <form method="POST" id="formEliminarUsuario" class="space-y-6">
                        @csrf
                        @method('DELETE')

                        <div class="space-y-6">
                            <div>
                                <flux:heading size="lg">{{ __('¿Estás segur@ que quieres eliminar esta cuenta?') }}</flux:heading>
                                <flux:subheading>
                                    {{ __('Una vez que elimines esta cuenta, todos sus datos y recursos serán permanentemente eliminados.') }}
                                </flux:subheading>
                            </div>
                            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                                <flux:modal.close>
                                    <flux:button variant="filled">{{ __('Cancelar') }}</flux:button>
                                </flux:modal.close>
                            
                                <flux:button variant="danger" type="submit">{{ __('Eliminar cuenta') }}</flux:button>
                            </div>
                        </div>
                    </form>
                </flux:modal>
            </table>
        </div>
    </div>

<script>
    function prepararEliminacion(usuarioId) {
        const form = document.getElementById('formEliminarUsuario');
        form.action = `/admin/usuarios/${usuarioId}`; // o cambia la ruta según sea necesario
    }
</script>


</x-layouts.app>

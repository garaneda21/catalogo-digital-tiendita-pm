<x-layouts.app :title="__('Dashboard')">
    <x-panel.header nombre_header="{{ $admin->nombre_admin }}">
        <flux:button href="/admin/administradores" icon="arrow-left"
            class="dark:text-black! dark:bg-white! hover:bg-gray-200! rounded-3xl!">
            Volver
        </flux:button>
    </x-panel.header>

    <div class="mt-4 flex items-start max-md:flex-col">
        <div class="me-10 w-full pb-4 md:w-[220px]">
            <flux:navlist.group>
                <flux:navlist.item href="/admin/administradores/{{ $admin->id }}"
                    class="data-current:bg-gray-200! hover:underline!">Detalles</flux:navlist.item>

                @can('update', App\Models\Administrador::class)
                    <flux:navlist.item href="/admin/administradores/{{ $admin->id }}/edit"
                        class="data-current:bg-gray-200! hover:underline!">Editar Datos</flux:navlist.item>
                @endcan
                @if (!$admin->superadmin && Auth::user('admin')->can('update_permisos', App\Models\Administrador::class))
                    <flux:navlist.item href="/admin/administradores/{{ $admin->id }}/edit-permisos"
                        class="data-current:bg-gray-200! hover:underline!">Editar Permisos </flux:navlist.item>
                @endif
                <flux:navlist.item href="#" class="data-current:bg-gray-200! hover:underline!">Cambiar Contraseña
                </flux:navlist.item>
                <flux:navlist.item href="/admin/administradores/{{ $admin->id }}/historial"
                    class="data-current:bg-gray-200! hover:underline!">Historial de Acciones</flux:navlist.item>
                <!-- Botón y Modal para desactivar un admin -->
                @if (!$admin->superadmin && Auth::user('admin')->can('disable', App\Models\Administrador::class))
                    @if ($admin->activo)
                        <flux:modal.trigger name="disable-admin">
                            <flux:navlist.item class="hover:underline!">
                                Desactivar Admin
                            </flux:navlist.item>
                        </flux:modal.trigger>

                        <flux:modal name="disable-admin" class="min-w-[22rem]">
                            <div class="space-y-6">
                                <div>
                                    <flux:heading size="lg">¿Desactivar Administrador?</flux:heading>
                                    <flux:text class="mt-2">
                                        <p>Esta acción es reversible</p>
                                    </flux:text>
                                </div>
                                <div class="flex gap-2">
                                    <flux:spacer />
                                    <flux:modal.close>
                                        <flux:button variant="ghost">Cancelar</flux:button>
                                    </flux:modal.close>
                                    <flux:button href="{{ route('administradores.disable', $admin) }}" variant="danger">
                                        Aceptar</flux:button>
                                </div>
                            </div>
                        </flux:modal>
                    @else
                        <flux:navlist.item href="{{ route('administradores.disable', $admin) }}"
                            class="hover:underline!">Reactivar Admin</flux:navlist.item>
                    @endif
                @endif

                <flux:separator class="my-2" />

                <!-- Eliminar Admin -->
                @if (!$admin->superadmin)
                    <flux:navlist.item href="/admin/administradores/{{ $admin->id }}/delete"
                        class="data-current:bg-gray-200! text-red-500! hover:underline!">Eliminar Admin</flux:navlist.item>
                @endif

            </flux:navlist.group>
        </div>

        <flux:separator class="md:hidden" />

        <div class="flex-1 self-stretch max-md:pt-6">
            {{ $slot }}
        </div>
    </div>
</x-layouts.app>

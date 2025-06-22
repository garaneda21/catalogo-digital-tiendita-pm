<x-layouts.app :title="__('Dashboard')">
    <x-panel.header nombre_header="{{ $producto->nombre_producto }}">
        <flux:button href="/admin/productos" icon="arrow-left"
            class="dark:text-black! dark:bg-white! hover:bg-gray-200! rounded-3xl!">
            Volver
        </flux:button>
    </x-panel.header>

    <div class="mt-4 flex items-start max-md:flex-col">
        <div class="me-10 w-full pb-4 md:w-[220px]">
            <flux:navlist.group>
                <flux:navlist.item href="/admin/productos/{{ $producto->id }}"
                    class="data-current:bg-gray-200! hover:underline!">Detalles</flux:navlist.item>

                @can('update', App\Models\Producto::class)
                    <flux:navlist.item href="/admin/productos/{{ $producto->id }}/edit"
                        class="data-current:bg-gray-200! hover:underline!">Editar</flux:navlist.item>

                    @if ($producto->activo)
                        <flux:navlist.item href="" class="text-red-500! hover:underline!">
                            Desactivar Producto
                        </flux:navlist.item>
                    @else
                        <flux:navlist.item href="" class="hover:underline!">Reactivar</flux:navlist.item>
                    @endif
                @endcan


                <flux:separator class="my-2" />

                @can('delete', App\Models\Producto::class)
                    <flux:modal.trigger name="destroy-producto">
                        <flux:navlist.item class="data-current:bg-gray-200! hover:underline! text-red-500!">
                            Eliminar
                        </flux:navlist.item>
                    </flux:modal.trigger>

                    <flux:modal name="destroy-producto" class="min-w-[22rem]">
                        <div class="space-y-6">
                            <div>
                                <flux:heading size="lg">¿Eliminar Producto?</flux:heading>
                                <flux:text class="mt-2">
                                    <p>Esta acción es Irreversible</p>
                                </flux:text>
                            </div>
                            <div class="flex gap-2">
                                <flux:spacer />
                                <flux:modal.close>
                                    <flux:button variant="ghost">Cancelar</flux:button>
                                </flux:modal.close>
                                <form method="POST" action="{{ route('productos.destroy', $producto->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button type="submit" variant="danger">
                                        Aceptar
                                    </flux:button>
                                </form>
                            </div>
                        </div>
                    </flux:modal>
                @endcan
            </flux:navlist.group>
        </div>

        <flux:separator class="md:hidden" />

        <div class="flex-1 self-stretch max-md:pt-6">
            {{ $slot }}
        </div>
    </div>
</x-layouts.app>

<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header="Categorías">
        @can('create', App\Models\Categoria::class)
            <flux:button href="/admin/categorias/create" icon="plus" variant="primary"
                class="text-white bg-verde-oliva rounded-3xl! hover:bg-verde-oliva/70">
                Nueva Categoría
            </flux:button>
        @else
            <flux:tooltip content="No tienes permiso para esta acción">
                <div>
                    <flux:button disabled icon="plus"
                        class="text-black bg-verde-oliva rounded-3xl! hover:bg-verde-oliva/70">
                        Nueva Categoría
                    </flux:button>
                </div>
            </flux:tooltip>
        @endcan
    </x-panel.header>

    @can('viewAny', App\Models\Categoria::class)
        <div class="py-4 space-y-2 mx-auto">

            @if (session('success'))
                <x-mensaje-accion icon="check-circle" variant="success" heading="{{ session('success') }}" />
            @endif

            @foreach ($categorias as $categoria)
                <div class="bg-white border-2 rounded-xl p-3 flex flex-col md:flex-row items-center justify-between gap-4">

                    <!-- Info de la categoría -->
                    <div class="flex-1">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $categoria->nombre_categoria }}</h2>
                    </div>

                    <!-- Botón editar -->
                    @can('update', App\Models\Categoria::class)
                        <a href="{{ route('categorias.edit', $categoria->id) }}">
                            <button class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition">
                                Editar
                            </button>
                        </a>
                    @endcan

                    <!-- Botón eliminar -->
                    @can('delete', App\Models\Categoria::class)
                        <button data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $categoria->id }}"
                            class="px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition">
                            Eliminar
                        </button>
                    @endcan

                    <!-- Modal eliminar -->
                    <div class="modal fade fixed top-0 left-0 w-full h-full bg-black/50 z-50 hidden"
                        id="confirmDelete{{ $categoria->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog relative top-1/4 mx-auto max-w-md">
                            <div class="modal-content bg-white rounded-lg shadow-lg p-6">
                                <div class="modal-header flex justify-between items-center">
                                    <h5 class="text-xl font-medium">Confirmar eliminación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body mt-4">
                                    <p>¿Estás seguro de que deseas eliminar
                                        <strong>{{ $categoria->nombre_categoria }}</strong>?
                                    </p>
                                </div>
                                <div class="modal-footer flex justify-end mt-4 space-x-2">
                                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1.5 px-4 rounded text-sm">
                                            Sí, eliminar</button>
                                    </form>
                                    <button type="button"
                                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-1.5 px-4 rounded text-sm"
                                        data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <div class="flex items-center justify-center h-64">
            <div class="text-center">
                <p class="text-lg font-semibold text-gray-600">No tienes permiso para ver las categorías.</p>
            </div>
        </div>
    @endcan
</x-layouts.app>

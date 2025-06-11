<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header="Categorías">
        <flux:button href="/admin/categorias/create" icon="plus" variant="primary"
            class="text-white bg-verde-oliva rounded-3xl! hover:bg-verde-oliva/70">
            Nueva Categoría
        </flux:button>
    </x-panel.header>

    <div class="py-4 space-y-2 mx-auto">

        @foreach (['success_create', 'success_update', 'success_delete'] as $flash)
            @if (session($flash))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">¡Éxito!</strong>
                    <span class="block sm:inline">{{ session($flash) }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            onclick="this.parentElement.parentElement.style.display='none';">
                            <title>Cerrar</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 2.65a1.2 1.2 0 1 1-1.697-1.697L8.303 10l-2.651-2.651a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-2.651a1.2 1.2 0 1 1 1.697 1.697L11.697 10l2.651 2.651a1.2 1.2 0 0 1 0 1.697z" />
                        </svg>
                    </span>
                </div>
            @endif
        @endforeach

        @foreach ($categorias as $categoria)
            <div
                class="bg-white border-2 rounded-xl p-3 flex flex-col md:flex-row items-center justify-between gap-4">

                <!-- Info de la categoría -->
                <div class="flex-1">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $categoria->nombre_categoria }}</h2>
                </div>

                <!-- Botón editar -->
                <a href="{{ route('categorias.edit', $categoria->id) }}">
                    <button
                        class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition">
                        Editar
                    </button>
                </a>

                <!-- Botón eliminar -->
                <button data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $categoria->id }}"
                    class="px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition">
                    Eliminar
                </button>

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



</x-layouts.app>

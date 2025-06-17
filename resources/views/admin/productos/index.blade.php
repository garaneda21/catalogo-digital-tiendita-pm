<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header="Productos">
        @can('create', App\Models\Producto::class)
            <flux:button href="/admin/productos/create" icon="plus" variant="primary"
                class="text-white bg-verde-oliva rounded-3xl! hover:bg-verde-oliva/70">
                Nuevo Producto
            </flux:button>
        @else
            <flux:tooltip content="No tienes permiso para esta acción">
                <div>
                    <flux:button disabled icon="plus"
                        class="text-black bg-verde-oliva rounded-3xl! hover:bg-verde-oliva/70">
                        Nuevo Producto
                    </flux:button>
                </div>
            </flux:tooltip>
        @endcan
    </x-panel.header>

    @can('viewAny', App\Models\Producto::class)
        <div class="py-4 space-y-2 mx-auto">

            @if (session('success'))
                <x-mensaje-accion icon="check-circle" variant="success" heading="{{ session('success') }}" />
            @endif

            <x-ordenamiento-y-busqueda></x-ordenamiento-y-busqueda>

            @foreach ($productos as $producto)
                <div
                    class="bg-white border-2 rounded-xl p-3 flex flex-col md:flex-row items-start md:items-center gap-4 md:gap-6">

                    <!-- Imagen -->
                    <div class="w-full md:w-20 h-20 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                        <img src="{{ $producto->imagen_url ? asset('storage/' . $producto->imagen_url) : '/images/placeholder-product.jpg' }}"
                            alt="{{ $producto->nombre_producto }}" class="w-full h-full object-cover">
                    </div>

                    <!-- Info del producto -->
                    <div class="flex-1 space-y-1">
                        <h2 class="text-lg font-semibold text-gray-800"><a href="#" data-bs-toggle="modal"
                                data-bs-target="#modal{{ $producto->id }}">{{ $producto->nombre_producto }}</a></h2>

                        <div class="text-sm text-gray-600">
                            <span class="font-medium">Precio:</span> ${{ $producto->precio }}<br>
                            <span class="font-medium">Stock:</span> {{ $producto->stock_actual }} unidades<br>
                            <span class="font-medium">Categoría:</span>
                            {{ $producto->categoria->nombre_categoria ?? 'SIN CATEGORÍA' }}
                        </div>
                    </div>


                    <flux:button href="/admin/movimientos/entrada/{{ $producto->id }}/create-stock"
                        icon="plus-circle" class="text-amber-700!">
                        Ingreso Stock
                    </flux:button>

                    <flux:button href="/admin/movimientos/salida/{{ $producto->id }}/create-venta"
                        icon="banknotes" class="text-green-700!">
                        Venta Rápida
                    </flux:button>

                    @can('update', App\Models\Producto::class)
                        <!-- Botón editar -->
                        <flux:button href="{{ route('productos.edit', $producto->id) }}" icon="pencil-square"
                            class="text-blue-700!">
                            Editar
                        </flux:button>
                    @endcan
                    @can('delete', App\Models\Producto::class)
                        <flux:button data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $producto->id }}" icon="trash"
                            class="text-red-500!">
                            Eliminar
                        </flux:button>
                    @endcan

                    <!-- Modal de confirmación de eliminación -->
                    <div class="modal fade fixed top-0 left-0 w-full h-full bg-black/50 z-50 hidden"
                        id="confirmDelete{{ $producto->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog relative top-1/4 mx-auto max-w-md">
                            <div class="modal-content bg-white rounded-lg shadow-lg p-6">
                                <div class="modal-header flex justify-between items-center">
                                    <h5 class="text-xl font-medium">Confirmar eliminación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body mt-4">
                                    <p>¿Estás seguro de que deseas eliminar
                                        <strong>{{ $producto->nombre_producto }}</strong>?
                                    </p>
                                </div>
                                <div class="modal-footer flex justify-end mt-4 space-x-2">
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
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

                    <!-- Modal para ver detalles de producto (con bootstrap)-->
                    <!-- Se activará cuando se clickee el nombre del producto -->
                    <!-- Modal -->
                    <div class="modal fade fixed inset-0 z-50 bg-black/50 hidden" id="modal{{ $producto->id }}"
                        tabindex="-1" aria-hidden="true">

                        <div class="modal-dialog relative mx-auto mt-24 w-full max-w-sm">
                            <div class="modal-content bg-white rounded-lg shadow-lg max-h-[80vh] overflow-y-auto">

                                <!-- Header -->
                                <div class="modal-header flex items-center justify-between p-4 border-b">
                                    <h5 class="text-lg font-semibold text-gray-900">{{ $producto->nombre_producto }}</h5>
                                    <button type="button"
                                        class="text-gray-500 hover:text-gray-700 focus:outline-none text-2xl font-bold"
                                        data-bs-dismiss="modal" aria-label="Close">
                                        &times;
                                    </button>
                                </div>

                                <!-- Body -->
                                <div class="modal-body p-4 space-y-3 text-gray-800">
                                    <img src="https://placehold.co/500x500" alt="Imagen del producto"
                                        class="aspect-square w-full bg-gray-200 object-cover rounded">

                                    <p><strong>Precio:</strong> ${{ number_format($producto->precio, 0, ',', '.') }}</p>
                                    <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                                </div>

                                <!-- Footer -->
                                <div class="modal-footer flex justify-end p-4 border-t">
                                    <button type="button"
                                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded"
                                        data-bs-dismiss="modal">
                                        Cerrar
                                    </button>
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
                <p class="text-lg font-semibold text-gray-600">No tienes permiso para ver los productos.</p>
            </div>
        </div>
    @endcan
</x-layouts.app>

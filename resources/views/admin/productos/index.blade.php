<x-layouts.panel>

    <div class="py-4 mx-auto">
        <form class="flex w-full">
            <input type="text" name="search" placeholder="Buscar producto..." value="{{ request('search') }}"
                class="flex-grow px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" />
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white text-sm rounded-r-md hover:bg-blue-700 transition">
                Buscar
            </button>
        </form>
    </div>

    <!-- El botón para orderar y cambiar tipo de vista -->

    <!-- <div class="flex justify-between items-center mb-6"> -->
    <!--     <p class="text-gray-500">ordenar por: </p> -->
    <!--     <button class="bg-gray-300 p-2 rounded hover:bg-gray-400 px-5">☰</button> -->
    <!-- </div> -->


    <div class="py-4 space-y-2 mx-auto">

        <div>
            {{ $productos->appends(['search' => request('search')])->links() }}
        </div>

        <form method="GET" class="mb-4">
            <input type="hidden" name="search" value="{{ request('search') }}">

            <label for="ordering" class="bloce mb-1 text-sm font-medium text-gray-700">Ordenar por:</label>
            <select name="ordering" id="ordering" onchange="this.form.submit()"
                class="block bg-[#587A6C] text-[#F7F5F2] w-full max-w-xs px-3 py-2 rounded-2xl shadow-sm focus:outline focus:ring-blue-500 focus:border-blue-500 text-sm">
                <option value="">-- Seleccionar --</option>
                <option value="nombre_asc" {{ request('ordering') == 'nombre_asc' ? 'selected' : '' }}>Nombre (A-Z)
                </option>
                <option value="nombre_desc" {{ request('ordering') == 'nombre_desc' ? 'selected' : '' }}>Nombre
                    (Z-A)</option>
                <option value="precio_asc" {{ request('ordering') == 'precio_asc' ? 'selected' : '' }}>Precio (menor
                    a mayor)</option>
                <option value="precio_desc" {{ request('ordering') == 'precio_desc' ? 'selected' : '' }}>Precio
                    (mayor a menor)</option>
            </select>
        </form>

        @foreach ($productos as $producto)
            <div
                class="bg-white shadow-md rounded-xl p-3 flex flex-col md:flex-row items-start md:items-center gap-4 md:gap-6">

                <!-- Imagen -->
                <div class="w-full md:w-20 h-20 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                    <img src="{{ $producto->imagen_url ?? '/images/placeholder-product.jpg' }}"
                        alt="{{ $producto->nombre_producto }}" class="w-full h-full object-cover">
                </div>

                <!-- Info del producto -->
                <div class="flex-1 space-y-1">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $producto->nombre_producto }}</h2>

                    <div class="text-sm text-gray-600">
                        <span class="font-medium">Precio:</span> ${{ $producto->precio }}<br>
                        <span class="font-medium">Stock:</span> {{ $producto->stock_actual }} unidades<br>
                        <span class="font-medium">Categoría:</span> {{ $producto->categoria->nombre_categoria }}
                    </div>
                </div>

                <!-- Botón editar -->
                <div class="w-full md:w-auto">
                    <a href="{{ route('productos.edit', $producto->id) }}">
                        <button
                            class="inline-block px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition">
                            Editar
                        </button>
                    </a>
                </div>

                <!-- Botón eliminar -->
                <div class="w-full md:w-auto">
                    <button data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $producto->id }}"
                        class="inline-block px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition">
                        Eliminar
                    </button>
                </div>
                <!-- Modal de confirmación de eliminación -->
                <div class="modal fade" id="confirmDelete{{ $producto->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirmar eliminación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>¿Estás seguro de que deseas eliminar
                                    <strong>{{ $producto->nombre_producto }}</strong>?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Sí, eliminar</button>
                                </form>
                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


</x-layouts.panel>

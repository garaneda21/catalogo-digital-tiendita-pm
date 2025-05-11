<x-layouts.estructura>


    <div class="bg-[#fcf6ed]">


        <div class="mx-auto max-w-2xl p-4 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">

            <div class="py-4 mx-auto">
                <form class="flex w-full">
                    <input type="text" name="search" placeholder="Buscar producto..." value="{{ request('search') }}"
                        class="flex-grow px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" />
                    <button type="submit"
                        class="px-4 py-2 bg-[#587A6C] text-[#F7F5F2] text-sm rounded-r-md hover:bg-blue-700 transition">
                        Buscar
                    </button>
                </form>
            </div>

            <div class="p-4">
                {{ $productos->links() }}
            </div>

            <form method="GET" class="mb-4">
                <!-- Input oculto con la búsqueda realizada anteriormente -->
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

            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">

                @foreach ($productos as $producto)
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal{{ $producto->id }}"
                        class="border rounded-2xl overflow-hidden group shadow hover:shadow-lg bg-gray-50 hover:bg-gray-100">
                        <img src="{{ $producto->imagen_url ?? '/images/placeholder-product.jpg' }}"
                            alt="{{ $producto->nombre_producto }}"
                            class="aspect-square w-full bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-7/8">
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-800">
                                {{ $producto->nombre_producto }}
                            </h2>
                            <p class="text-xl font-bold text-pink-600 mt-2">
                                ${{ number_format($producto->precio, 0, ',', '.') }}</p>
                            <p class="text-md text-gray-500 mt-1">{{ $producto->categoria->nombre_categoria }}</p>
                        </div>
                    </a>

                    <!-- Modal para ver detalles de producto (con bootstrap)-->
                    <div class="modal fade" id="modal{{ $producto->id }}" tabindex="-1">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><strong>{{ $producto->nombre_producto }}</strong></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="https://placehold.co/500x500" alt=""
                                        class="aspect-square w-full bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-7/8">
                                    <p><strong>Precio:</strong> ${{ number_format($producto->precio, 0, ',', '.') }}
                                    </p>
                                    <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-layouts.estructura>

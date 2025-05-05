<x-layouts.panel>

    <div class="flex justify-between items-center mb-6">
        <input type="text" placeholder="Buscar..." class="border px-4 py-2 rounded w-1/2">
        <button class="bg-gray-300 p-2 rounded hover:bg-gray-400">☰</button>
    </div>

    <div>
        {{ $productos->links() }}
    </div>

    <div class="space-y-2 p-4 mx-auto">

        @foreach ($productos as $producto)
            <div
                class="bg-white shadow-md rounded-xl p-4 flex flex-col md:flex-row items-start md:items-center gap-4 md:gap-6">

                <!-- Imagen -->
                <div class="w-full md:w-28 h-28 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                    <img src="https://placehold.co/400x400" alt="Perfume Floral" class="w-full h-full object-cover">
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
                    <a href="">
                        <button
                            class="inline-block px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition">
                            Editar
                        </button>
                    </a>
                </div>
            </div>
        @endforeach


    </div>

    <div>
        {{ $productos->links() }}
    </div>

</x-layouts.panel>

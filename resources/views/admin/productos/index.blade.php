<x-layouts.panel>

    <div class="py-4 mx-auto">
        <form class="flex w-full">
            <input type="text" name="search" placeholder="Buscar producto..."
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

        @foreach ($productos as $producto)
            <div class="bg-white shadow-md rounded-xl p-4 flex flex-col md:flex-row items-start md:items-center gap-4 md:gap-6">

                <!-- Imagen -->
                <div class="w-full md:w-20 h-20 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                    <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre_producto }}" class="w-full h-full object-cover">
                    <img src="{{ asset($producto->imange_url) }}">
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
            </div>
        @endforeach
    </div>


</x-layouts.panel>

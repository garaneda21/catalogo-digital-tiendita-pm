<x-layouts.estructura>


    <div class="bg-white">


        <div class="mx-auto max-w-2xl p-4 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">

            <div class="p-4">
                {{ $productos->links() }}
            </div>

            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">

                @foreach ($productos as $producto)
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal{{ $producto->id }}" class="border rounded-2xl overflow-hidden group hover:bg-gray-50">
                        <img src="https://placehold.co/500x500" alt=""
                            class="aspect-square w-full bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-7/8">
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-800">
                                {{ $producto->nombre_producto }}
                            </h2>
                            <p class="text-xl font-bold text-pink-600 mt-2">${{ number_format($producto->precio, 0, ',', '.') }}</p>
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
                                    <p><strong>Precio:</strong> ${{ number_format($producto->precio, 0, ',', '.') }}</p>
                                    <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-layouts.estructura>

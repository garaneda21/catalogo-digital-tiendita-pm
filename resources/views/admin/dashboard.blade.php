<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header="Dashboard"></x-panel.header>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 my-6">
        <div class="bg-gray-50 p-4 rounded-lg border">
            <span class="text-md text-gray-500">Ventas este mes</span>
            <p class="text-xl font-bold text-azul-profundo">
                <span class="text-2xl">{{ $ventas_mes }}</span> unidades
            </p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg border">
            <span class="text-md text-gray-500">Entradas este mes</span>
            <p class="text-xl font-bold text-azul-profundo">
                <span class="text-2xl">{{ $entradas_mes }}</span> unidades
            </p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg border">
            <span class="text-md text-gray-500">Productos bajos en stock</span>
            <p class="text-xl font-bold text-red-500">
                <span class="text-2xl">{{ $bajo_stock }}</span> productos
            </p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg border">
            <span class="text-md text-gray-500">Total productos</span>
            <p class="text-xl font-bold text-azul-profundo">
                <span class="text-2xl">{{ $total_productos }}</span> unidades
            </p>
        </div>
    </div>

    <h2 class="text-2xl text-azul-profundo font-bold my-6">Productos más vendidos</h2>

    <div class="mt-6 overflow-x-auto">
        <div class="flex space-x-4 min-w-full px-1">
            @foreach ($top_productos as $i => $top_producto)
                <div class="w-[350px] bg-gray-50 border rounded-xl p-4 flex-shrink-0">
                    <div class="flex items-start space-x-4 mb-4">
                        <!-- Imagen -->
                        <img class="w-16 h-16 object-cover rounded-md shrink-0"
                            src="{{ $top_producto->imagen_url ?? '/images/placeholder-product.jpg' }}"
                            alt="Imagen de {{ $top_producto->nombre_producto }}">

                        <!-- Contenido textual -->
                        <div class="min-w-0">
                            <h3 class="font-sans! text-lg font-semibold text-[#3D3C63] truncate">
                                {{ $i + 1 }}. {{ $top_producto->producto->nombre_producto }}
                            </h3>
                            <div class="text-sm text-gray-500">Categoría:
                                {{ $top_producto->producto->categoria->nombre_categoria ?? 'N/A' }}</div>
                            <div class="text-sm text-gray-500 mb-1">
                                Stock actual: {{ $top_producto->producto->stock_actual }}
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <span
                            class="text-sm font-bold bg-verde-oliva/10 text-verde-oliva px-2 py-1 rounded-full whitespace-nowrap">
                            {{ $top_producto->total }} vendidas
                        </span>
                        <a href="#" class="text-sm text-melocoton hover:underline">Ver detalles</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <h2 class="text-2xl text-azul-profundo font-bold my-6">Últimos Movimientos</h2>

    <div class="overflow-auto rounded-lg border">
        <table class="w-full">
            <thead class="bg-gray-200 text-azul-profundo">
                <tr>
                    <th class="p-2 text-sm font-semibold tracking-wide text-left">Producto (ID)</th>
                    <th class="w-32 p-2 text-sm font-semibold tracking-wide text-left">Precio</th>
                    <th class="w-24 p-2 text-sm font-semibold tracking-wide text-left">Cantidad</th>
                    <th class="w-24 p-2 text-sm font-semibold tracking-wide text-left">Tipo</th>
                    <th class="p-2 text-sm font-semibold tracking-wide text-left">Motivo</th>
                    <th class="p-2 text-sm font-semibold tracking-wide text-left">Fecha</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($movimientos as $movimiento)
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td class="p-3 text-sm text-gray-700 font-bold whitespace-nowrap">
                            <a href="#" class="font-bold text-melocoton hover:underline">
                                {{ $movimiento->producto->nombre_producto }}
                            </a>
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">$
                            {{ number_format($movimiento->producto->precio * $movimiento->cantidad, 0, ',', '.') }}
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            {{ $movimiento->cantidad }}
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            {{ ucfirst($movimiento->tipo_movimiento->nombre_tipo) }}
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            {{ $movimiento->motivo_movimiento->nombre_motivo }}
                        </td>
                        <td class="p-3 text-rig text-sm text-gray-700 whitespace-nowrap">
                            {{ $movimiento->created_at }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>

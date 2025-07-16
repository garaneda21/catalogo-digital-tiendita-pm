<x-layouts.navlist-productos :producto="$producto">

    @if (session('success'))
        <x-mensaje-accion icon="check-circle" variant="success" heading="{{ session('success') }}" />
    @endif

    <h2 class="mb-4 text-2xl text-azul-profundo font-bold">Detalles</h2>

    @can('view', App\Models\Producto::class)
        <div class="flex flex-col xl:flex-row gap-6 bg-white">
            <!-- Imagen a la izquierda -->
            <div class="w-full max-w-[240px]">
                <div class="overflow-hidden border rounded-lg aspect-square">
                    <img src="{{ $producto->imagen_url ? asset('storage/' . $producto->imagen_url) : '/images/placeholder-product.jpg' }}"
                        alt="Imagen del producto"
                        class="object-cover w-full h-full {{ $producto->activo ? '' : 'grayscale-75' }}">
                </div>
            </div>

            <!-- Detalles del producto -->
            <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4 text-azul-profundo">
                <div class="border p-2 rounded-lg bg-gray-50">
                    <p class="text-gray-500 text-sm mb-1">Nombre</p>
                    <p class="font-medium">{{ $producto->nombre_producto }}</p>
                </div>

                <div class="border p-2 rounded-lg bg-gray-50">
                    <p class="text-gray-500 text-sm mb-1">Categoría</p>
                    <p>{{ $producto->categoria->nombre_categoria ?? 'Sin categoría' }}</p>
                </div>

                <div class="border p-2 rounded-lg bg-gray-50">
                    <p class="text-gray-500 text-sm mb-1">Precio</p>
                    <p>{{ '$' . number_format($producto->precio, 0, ',', '.') }}</p>
                </div>

                <div class="border p-2 rounded-lg bg-gray-50">
                    <p class="text-gray-500 text-sm mb-1">Stock</p>
                    <p>{{ $producto->stock_actual }}</p>
                </div>

                <div class="border p-2 rounded-lg bg-gray-50">
                    <p class="text-gray-500 text-sm mb-1">Estado</p>
                    @if ($producto->activo)
                        <p class="text-green-600">Activo</p>
                    @else
                        <p class="text-red-600">Desactivado</p>
                    @endif
                </div>

                @if ($producto->destacado)
                    <div class="border p-2 rounded-lg bg-gray-50">
                        <p class="text-gray-500 text-sm mb-1">Destacado</p>
                        <p class="text-amber-500">Destacado</p>
                    </div>
                @endif

                <div class="border p-2 rounded-lg bg-gray-50">
                    <p class="text-gray-500 text-sm mb-1">Creado el</p>
                    <p>{{ $producto->created_at->format('d/m/Y H:i') }}</p>
                </div>

                @if ($producto->descripcion)
                    <div class="sm:col-span-2 border p-2 rounded-lg bg-gray-50">
                        <p class="text-gray-500 text-sm mb-1">Descripción</p>
                        <p class="text-justify">{{ $producto->descripcion }}</p>
                    </div>
                @endif
            </div>
        </div>

        <h2 class="my-4 text-2xl text-azul-profundo font-bold">Movimientos del Producto</h2>

        <form method="GET" class="mb-6 grid md:grid-cols-3 gap-4 items-end">
            <flux:select name="tipo" label="Tipo">
                <option value="">Todas</option>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id }}" @selected(request('tipo') == $tipo->id)>
                        {{ $tipo->nombre_tipo }}
                    </option>
                @endforeach
            </flux:select>
            <flux:select name="motivo" label="Motivo">
                <option value="">Todas</option>
                @foreach ($motivos as $motivo)
                    <option value="{{ $motivo->id }}" @selected(request('motivo') == $motivo->id)>
                        {{ $motivo->nombre_motivo }}
                    </option>
                @endforeach
            </flux:select>
            <flux:select name="ordenar" label="Orderar por">
                <option value="fecha_desc" {{ request('ordenar') == 'fecha_desc' ? 'selected' : '' }}>Más Recientes
                </option>
                <option value="fecha_asc" {{ request('ordenar') == 'fecha_asc' ? 'selected' : '' }}>Más Antiguos</option>
                <option value="cantidad_desc" {{ request('ordenar') == 'cantidad_desc' ? 'selected' : '' }}>Mayor Cantidad
                </option>
                <option value="cantidad_asc" {{ request('ordenar') == 'cantidad_asc' ? 'selected' : '' }}>Menor Cantidad
                </option>
            </flux:select>

            <div class="flex space-x-2">
                <flux:button type="submit" class="bg-verde-oliva!" variant="primary">Filtrar</flux:button>
                <flux:button href="/admin/productos/{{ $producto->id }}">Limpiar</flux:button>
            </div>
        </form>

        <div class="mt-4">
            {{ $movimientos->links() }}
        </div>

        <div class="mt-4 overflow-hidden rounded-lg border-1">
            <table class="min-w-full border-separate border-spacing-0 text-sm">
                <thead class="bg-gray-200 text-azul-profundo">
                    <tr>
                        <th class="px-4 py-2 text-left">Tipo</th>
                        <th class="px-4 py-2 text-left">Motivo</th>
                        <th class="px-4 py-2 text-left">Cantidad</th>
                        <th class="px-4 py-2 text-left">Fecha</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-[#3D3C63]">
                    @foreach ($movimientos as $movimiento)
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-700 whitespace-nowrap">
                                {{ ucfirst($movimiento->tipo_movimiento->nombre_tipo) }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700 whitespace-nowrap">
                                {{ $movimiento->motivo_movimiento->nombre_motivo }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700 whitespace-nowrap">
                                {{ $movimiento->cantidad }}
                            </td>
                            <td class="px-4 py-2 text-rig text-sm text-gray-700 whitespace-nowrap">
                                {{ $movimiento->created_at }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="flex items-center justify-center h-64">
            <div class="text-center">
                <p class="text-lg font-semibold text-gray-600">No tienes permisos para ver los detalles de los productos
                </p>
            </div>
        </div>
    @endcan

</x-layouts.navlist-productos>

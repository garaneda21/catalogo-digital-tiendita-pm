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

            <div class="mb-4">
                {{ $productos->links() }}
            </div>

            <div class="hidden md:block overflow-auto rounded-lg border">
                <table class="min-w-full border-separate border-spacing-0 text-sm">
                    <thead class="bg-gray-200 text-azul-profundo">
                        <tr>
                            <th class="w-24 px-4 py-2 text-left">Imágen</th>
                            <th class="px-4 py-2 text-left">Nombre Producto</th>
                            <th class="w-50 px-4 py-2 text-left">Categoría</th>
                            <th class="w-34 px-4 py-2 text-left">Precio</th>
                            <th class="w-16 px-4 py-2 text-left">Stock</th>
                            <th class="w-34 px-4 py-2 text-left">Estado Stock</th>
                            <th class="w-60 px-4 py-2 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-[#3D3C63]">
                        @foreach ($productos as $producto)
                            <tr class="odd:bg-white even:bg-gray-100"">
                                <td class="px-4 py-1">
                                    <div class="w-15 h-15 bg-gray-100 border rounded-lg overflow-hidden flex-shrink-0">
                                        <img src="{{ $producto->imagen_url ? asset('storage/' . $producto->imagen_url) : '/images/placeholder-product.jpg' }}"
                                            alt="{{ $producto->nombre_producto }}" class="w-full h-full object-cover">
                                    </div>
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap font-bold">{{ $producto->nombre_producto }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $producto->categoria->nombre_categoria }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    {{ '$' . number_format($producto->precio, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 whitespace-nowrap font-bold">{{ $producto->stock_actual }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    @if ($producto->stock_actual >= 6)
                                        <flux:badge variant="pill" color="zinc">Normal</flux:badge>
                                    @elseif ($producto->stock_actual > 0)
                                        <flux:badge variant="pill" color="yellow">Bajo</flux:badge>
                                    @else
                                        <flux:badge variant="pill" color="red">Agotado</flux:badge>
                                    @endif
                                </td>
                                <td class="space-x-2 px-4 py-2 whitespace-nowrap font-bold text-right ">
                                    @can('update', App\Models\Producto::class)
                                        <flux:button href="/admin/movimientos/entrada/{{ $producto->id }}/create-stock"
                                            icon="plus-circle" class="text-amber-700!" tooltip="Ingresar Stock" />

                                        <flux:button href="/admin/movimientos/salida/{{ $producto->id }}/create-venta"
                                            icon="banknotes" class="text-green-700!" tooltip="Venta rápida" />
                                    @endcan

                                    <flux:button href="{{ route('productos.show', $producto->id) }}" icon="list-bullet"
                                        class="text-blue-700!" tooltip="Ver detalles" />

                                    @can('update', App\Models\Producto::class)
                                        <flux:button href="{{ route('productos.edit', $producto->id) }}" icon="pencil-square"
                                            class="text-blue-700!" tooltip="Editar Datos" />
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Lista productos versión movil -->
            <div class="flex md:hidden flex-col gap-2">
                @foreach ($productos as $producto)
                    <div class="w-full bg-gray-50 border rounded-xl p-4 flex-shrink-0">
                        <div class="flex items-start space-x-4 mb-2">
                            <!-- Imagen -->
                            <img class="w-16 h-16 object-cover rounded-md shrink-0"
                                src="{{ $producto->imagen_url ? asset('storage/' . $producto->imagen_url) : '/images/placeholder-product.jpg' }}"
                                alt="Imagen de {{ $producto->nombre_producto }}">

                            <!-- Contenido textual -->
                            <div class="min-w-0">
                                <h3 class="font-sans! font-semibold text-[#3D3C63] truncate">
                                    {{ $producto->nombre_producto }}
                                </h3>
                                <div class="text-sm text-gray-500">Categoría: {{ $producto->categoria->nombre_categoria }}
                                </div>
                                <div class="text-sm text-gray-500 mb-1">
                                    Stock actual: {{ $producto->stock_actual }}
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            @if ($producto->stock_actual >= 6)
                                <flux:badge variant="pill" color="zinc">Normal</flux:badge>
                            @elseif ($producto->stock_actual > 0)
                                <flux:badge variant="pill" color="yellow">Bajo</flux:badge>
                            @else
                                <flux:badge variant="pill" color="red">Agotado</flux:badge>
                            @endif
                            <div class="text-right">
                                <flux:button href="/admin/movimientos/entrada/{{ $producto->id }}/create-stock"
                                    icon="plus-circle" class="text-amber-700!" tooltip="Ingresar Stock" />

                                <flux:button href="/admin/movimientos/salida/{{ $producto->id }}/create-venta"
                                    icon="banknotes" class="text-green-700!" tooltip="Venta rápida" />

                                @can('view', App\Models\Producto::class)
                                    <flux:button href="{{ route('productos.show', $producto->id) }}" icon="list-bullet"
                                        class="text-blue-700!" tooltip="Ver detalles" />
                                @endcan

                                @can('update', App\Models\Producto::class)
                                    <flux:button href="{{ route('productos.edit', $producto->id) }}" icon="pencil-square"
                                        class="text-blue-700!" tooltip="Editar Datos" />
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="flex items-center justify-center h-64">
            <div class="text-center">
                <p class="text-lg font-semibold text-gray-600">No tienes permiso para ver los productos.</p>
            </div>
        </div>
    @endcan
</x-layouts.app>

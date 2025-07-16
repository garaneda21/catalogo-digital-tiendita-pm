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

            <form method="GET">
                <div class="mb-3 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4">
                    <flux:input label="Buscar Producto" name="search" value="{{ request('search') }}"
                        icon="magnifying-glass" placeholder="Buscar por nombre..." />

                    {{-- Selector de ordenamiento --}}
                    <flux:select name="ordering" id="ordering" onchange="this.form.submit()" label="Ordenar por">
                        <option value="">-- Seleccionar --</option>
                        <option value="recientes" @selected(request('ordering') == 'recientes')>Añadidos Recientemente</option>
                        <option value="nombre_asc" @selected(request('ordering') == 'nombre_asc')>Nombre (A-Z)</option>
                        <option value="nombre_desc" @selected(request('ordering') == 'nombre_desc')>Nombre (Z-A)</option>
                        <option value="precio_asc" @selected(request('ordering') == 'precio_asc')>Precio (menor a mayor)</option>
                        <option value="precio_desc" @selected(request('ordering') == 'precio:desc')>Precio (mayor a menor)</option>
                        <option value="stock_asc" @selected(request('ordering') == 'stock_asc')>Stock (menor a mayor)</option>
                        <option value="stock_desc" @selected(request('ordering') == 'stock_desc')>Stock (mayor a menor)</option>
                    </flux:select>

                    <flux:select name="categoria" onchange="this.form.submit()" label="Categorías">
                        <option value="">Todas las categorías</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" @selected(request('categoria') == $categoria->id)>
                                {{ $categoria->nombre_categoria }}
                            </option>
                        @endforeach
                    </flux:select>

                    <flux:select name="estado_stock" onchange="this.form.submit()" label="Estado Stock">
                        <option value="">Todo el stock</option>
                        <option value="agotado" @selected(request('estado_stock') == 'agotado')>Agotado</option>
                        <option value="bajo" @selected(request('estado_stock') == 'bajo')>Stock Bajo (1-5)</option>
                        <option value="normal" @selected(request('estado_stock') == 'normal')>Stock Normal (&gt; 5)</option>
                    </flux:select>

                    <flux:select name="activo" onchange="this.form.submit()" label="Productos Activos">
                        <option value="">Todos los estados</option>
                        <option value="1" @selected(request('activo') === '1')>Activos</option>
                        <option value="0" @selected(request('activo') === '0')>Inactivos</option>
                    </flux:select>
                </div>

                <div class="space-x-2 flex items-center">
                    <flux:button icon="funnel" type="submit" class="bg-verde-oliva!" variant="primary">Filtrar
                    </flux:button>
                    <flux:button href="{{ route('productos.index') }}">Limpiar</flux:button>
                </div>
            </form>

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
                            <th class="w-34 px-4 py-2 text-left">Activo</th>
                            <th class="w-24 px-4 py-2 text-left">Destacado</th>
                            <th class="w-60 px-4 py-2 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-[#3D3C63]">
                        @foreach ($productos as $producto)
                            <tr class="odd:bg-white even:bg-gray-100"">
                                <td class="px-4 py-1">
                                    <div class="w-15 h-15 bg-gray-100 border rounded-lg overflow-hidden flex-shrink-0">
                                        <img src="{{ $producto->imagen_url ? asset('storage/' . $producto->imagen_url) : '/images/placeholder-product.jpg' }}"
                                            alt="{{ $producto->nombre_producto }}"
                                            class="w-full h-full object-cover {{ $producto->activo ? '' : 'grayscale-75' }}">
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
                                <td class="px-4 py-2 whitespace-nowrap">
                                    @if ($producto->activo)
                                        <flux:badge variant="pill" color="green">Activo</flux:badge>
                                    @else
                                        <flux:badge variant="pill" color="gray">Desactivado</flux:badge>
                                    @endif
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    @if ($producto->destacado)
                                        <flux:badge variant="pill" color="amber">Si</flux:badge>
                                    @else
                                        <flux:badge variant="pill" color="gray">No</flux:badge>
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

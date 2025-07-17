<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header="Movimientos"></x-panel.header>

    <form method="GET">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 my-4">
            <flux:input label="Buscar Producto" name="search" value="{{ request('search') }}" icon="magnifying-glass"
                placeholder="Buscar por nombre..." />

            <flux:select onchange="this.form.submit()" name="categoria" label="Categoría del producto">
                <option value="">-- Todas --</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @selected(request('categoria') == $categoria->id)>
                        {{ $categoria->nombre_categoria }}
                    </option>
                @endforeach
            </flux:select>

            <flux:select onchange="this.form.submit()" name="tipo" label="Tipo de Movimiento">
                <option value="">-- Todos --</option>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id }}" @selected(request('tipo') == $tipo->id)>
                        {{ $tipo->nombre_tipo }}
                    </option>
                @endforeach
            </flux:select>

            <flux:select onchange="this.form.submit()" name="motivo" label="Motivo de Movimiento">
                <option value="">-- Todos --</option>
                @foreach ($motivos as $motivo)
                    <option value="{{ $motivo->id }}" @selected(request('motivo') == $motivo->id)>
                        {{ $motivo->nombre_motivo }}
                    </option>
                @endforeach
            </flux:select>

            @php
                $hoy = date('Y-m-d');
            @endphp

            <flux:input type="date" label="Desde" name="desde" value="{{ request('desde') }}"
                max="{{ $hoy }}" />
            <flux:input type="date" label="Hasta" name="hasta" value="{{ request('hasta') }}"
                max="{{ $hoy }}" />

            <flux:select onchange="this.form.submit()" name="ordering" label="Ordenar por">
                <option value="">-- Seleccionar --</option>
                <option value="nombre_asc" @selected(request('ordering') == 'nombre_asc')>Nombre (A-Z)</option>
                <option value="nombre_desc" @selected(request('ordering') == 'nombre_desc')>Nombre (Z-A)</option>
                <option value="precio_total_asc" @selected(request('ordering') == 'precio_total_asc')>Precio (menor a mayor)</option>
                <option value="precio_total_desc" @selected(request('ordering') == 'precio_total_desc')>Precio (mayor a menor)</option>
                <option value="cantidad_asc" @selected(request('ordering') == 'cantidad_asc')>Cantidad (menor a mayor)</option>
                <option value="cantidad_desc" @selected(request('ordering') == 'cantidad_desc')>Cantidad (mayor a menor)</option>
                <option value="fecha_asc" @selected(request('ordering') == 'fecha_asc')>Fecha (más antigua)</option>
                <option value="recientes" @selected(request('ordering') == 'recientes')>Fecha (más reciente)</option>
            </flux:select>
        </div>

        <div class="space-x-2 flex items-center">
            <flux:button icon="funnel" type="submit" class="bg-verde-oliva!" variant="primary">Filtrar
            </flux:button>
            <flux:button href="/admin/movimientos">Limpiar</flux:button>
        </div>
    </form>

    <div class="mb-4">
        {{ $movimientos->links() }}
    </div>

    <div class="mt-4 overflow-auto rounded-lg border">
        <table class="w-full">
            <thead class="bg-gray-200 text-azul-profundo">
                <tr>
                    <th class="p-2 text-sm font-semibold tracking-wide text-left">Producto (ID)</th>
                    <th class="w-32 p-2 text-sm font-semibold tracking-wide text-left">Categoria</th>
                    <th class="w-32 p-2 text-sm font-semibold tracking-wide text-left">Precio Total</th>
                    <th class="w-24 p-2 text-sm font-semibold tracking-wide text-left">Cantidad</th>
                    <th class="w-24 p-2 text-sm font-semibold tracking-wide text-left">Tipo</th>
                    <th class="p-2 text-sm font-semibold tracking-wide text-left">Motivo</th>
                    <th class="w-32 p-2 text-sm font-semibold tracking-wide text-left">Fecha</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($movimientos as $movimiento)
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td class="p-2 text-sm text-gray-700 font-bold whitespace-nowrap">
                            <a href="{{ route('productos.show', $movimiento->producto->id) }}"
                                class="font-bold text-melocoton hover:underline">
                                {{ $movimiento->producto->nombre_producto }}
                            </a>
                        </td>
                        <td class="p-2 text-sm text-gray-700 whitespace-nowrap">
                            {{ $movimiento->producto->categoria->nombre_categoria }}
                        </td>
                        <td class="p-2 text-sm text-gray-700 whitespace-nowrap">$
                            {{ number_format($movimiento->producto->precio * $movimiento->cantidad, 0, ',', '.') }}
                        </td>
                        <td class="p-2 text-sm text-gray-700 whitespace-nowrap">
                            {{ $movimiento->cantidad }}
                        </td>
                        <td class="p-2 text-sm text-gray-700 whitespace-nowrap">
                            {{ ucfirst($movimiento->tipo_movimiento->nombre_tipo) }}
                        </td>
                        <td class="p-2 text-sm text-gray-700 whitespace-nowrap">
                            {{ $movimiento->motivo_movimiento->nombre_motivo }}
                        </td>
                        <td class="p-2 text-rig text-sm text-gray-700 whitespace-nowrap">
                            {{ $movimiento->created_at }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>

<x-layouts.navlist-show-admins :admin="$admin">

    <h2 class="mb-4 text-2xl text-azul-profundo font-bold">Historial de Acciones</h2>

    <form method="GET" class="mb-6 grid md:grid-cols-4 gap-4 items-end">
        <flux:select name="accion" label="Acción">
            <option value="">Todas</option>
            @foreach ($acciones as $accion)
                <option value="{{ $accion }}" @selected(request('accion') == $accion)>
                    {{ $accion }}
                </option>
            @endforeach
        </flux:select>

        <flux:select name="entidad" label="Entidad Modificada">
            <option value="">Todas</option>
            <option value="sin_entidad" @selected(request('entidad') == 'sin_entidad')>Sin entidad</option>
            @foreach ($entidades as $entidad)
                <option value="{{ $entidad }}" @selected(request('entidad') == $entidad)>{{ $entidad }}</option>
            @endforeach
        </flux:select>

        <flux:input type="date" name="desde" value="{{ request('desde') }}" max="2999-12-31" label="Desde" />

        <flux:input type="date" name="hasta" value="{{ request('hasta') }}" max="2999-12-31" label="Hasta" />

        <div class="md:col-span-4 flex justify-end space-x-2">
            <flux:button type="submit" class="bg-verde-oliva!" variant="primary">Filtrar</flux:button>
            <flux:button href="{{ route('administradores.historial', $admin->id) }}">Limpiar</flux:button>
        </div>
    </form>

    <div class="mt-4">
        {{ $registros->withQueryString()->links() }}
    </div>

    @can('view', App\Models\Administrador::class)
        <div class="mt-4 overflow-hidden rounded-lg border-1">
            <table class="min-w-full border-separate border-spacing-0 text-sm">
                <thead class="bg-gray-200 text-azul-profundo">
                    <tr>
                        <th class="px-4 py-2 text-left">Acción</th>
                        <th class="px-4 py-2 text-left">Entidad Modificada</th>
                        <th class="px-4 py-2 text-left">Dato Modificado</th>
                        <th class="px-4 py-2 text-left">Fecha Registro</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-[#3D3C63]">
                    @foreach ($registros as $registro)
                        <tr class="hover:bg-[#FAFAFA]">
                            <td class="px-4 py-2">{{ $registro->accion->nombre_accion }}</td>
                            <td class="px-4 py-2">{{ $registro->entidad_modificada ?? '---' }}</td>
                            <td class="px-4 py-2">
                                @if ($registro->id_entidad_modificada)
                                    @switch($registro->dato_modificado->getTable())
                                        @case('productos')
                                            <a href="/admin/productos/{{ $registro->dato_modificado->id }}"
                                                class="text-melocoton hover:underline">
                                                {{ $registro->dato_modificado->nombre_producto }}
                                            </a>
                                        @break

                                        @case('categorias')
                                            {{ $registro->dato_modificado->nombre_categoria }}
                                        @break

                                        @case('users')
                                            {{ $registro->dato_modificado->name }}
                                        @break

                                        @case('administradores')
                                            <a href="/admin/administradores/{{ $registro->dato_modificado->id }}"
                                                class="text-melocoton hover:underline">
                                                {{ $registro->dato_modificado->nombre_admin }}
                                            </a>
                                        @break
                                    @endswitch
                                @else
                                    ---
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $registro->fecha_registro }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="flex items-center justify-center h-64">
            <div class="text-center">
                <p class="text-lg font-semibold text-gray-600">No tienes permiso para ver los detalles de un administrador.
                </p>
            </div>
        </div>
    @endcan
</x-layouts.navlist-show-admins>

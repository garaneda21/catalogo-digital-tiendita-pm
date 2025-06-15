<x-layouts.navlist-show-admins :admin="$admin">

    @if (session('success_update'))
        <x-mensaje-accion icon="check-circle" variant="success" heading="{{ session('success_update') }}"/>
    @endif

    <h2 class="text-2xl font-bold text-[#3D3C63] mb-2">Editor de permisos</h2>
    <p class="text-melocoton mb-4">Seleccione los permisos que tendrá el administrador y confirme los cambios</p>

    <form method="POST" action="{{ route('administradores.update-permisos', $admin->id) }}">
        @csrf
        @method('PUT')


        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($permisos as $categoria_permiso => $categorias_permiso)
                <div class="bg-white border rounded-2xl overflow-hidden">

                    <div class="bg-gray-50 px-4 py-2 text-azul-profundo font-semibold text-md border-b">
                        {{ $categoria_permiso }}
                    </div>

                    <!-- Lista de permisos -->
                    <div class="space-y-2 px-4 py-3">
                        @foreach ($categorias_permiso as $permiso)
                            <label
                                class="flex items-center border rounded-full px-4 py-2 bg-white text-azul-profundo text-sm cursor-pointer hover:bg-gray-50 transition duration-150">
                                <input type="checkbox" name="permisos[]" value="{{ $permiso->id }}"
                                    {{ $permisos_asignados->contains($permiso->id) ? 'checked' : '' }}
                                    class="form-checkbox w-4 h-4 mr-2 accent-verde-oliva">
                                {{ $permiso->nombre_permiso }}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex flex-col gap-6 mt-6">

            @if ($errors->any())
                <x-forms.error-card />
            @endif

            <div class="flex items-center justify-end gap-x-6">
                <flux:button type="submit" variant="primary" icon="arrow-path"
                    class="bg-verde-oliva hover:bg-verde-oliva/70! dark:text-black! dark:bg-white! rounded-3xl!">Editar
                    Permisos</flux:button>
            </div>
        </div>

    </form>

</x-layouts.navlist-show-admins>

<x-layouts.panel>

    <form method="post" action="/admin/categorias">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold text-gray-900">Crear nueva categoría</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <!-- Nombre Categoría -->
                    <x-form-field>
                        <x-form-label for="nombre_categoria">Nombre Categoría<span
                                class="text-blue-500">(requerido)</span></x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="nombre_categoria" id="nombre_categoria"
                                :value="old('nombre_categoria')"></x-form-input>
                        </div>
                        <x-form-error name="nombre_categoria"></x-form-error>
                    </x-form-field>

                    <!-- Descripción -->
                    <x-form-field>
                        <x-form-label for="descripcion">Descripción Categoría</x-form-label>
                        <div class="mt-2">
                            <x-form-textarea type="text" name="descripcion_categoria" id="descripcion_categoria">
                                {{ old('descripcion_categoria') }} </x-form-textarea>
                        </div>
                    </x-form-field>


                    @if ($errors->any())
                        <x-form-errorcard></x-form-errorcard>
                    @endif
                </div>
            </div>


            <div class="mt-6 flex items-center justify-end gap-x-6">
                <!-- <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancelar</button> -->
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar</button>
            </div>
        </div>
    </form>
</x-layouts.panel>

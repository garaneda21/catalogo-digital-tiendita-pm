<x-layouts.panel>

    <form method="post" enctype="multipart/form-data" action="/admin/productos">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold text-gray-900">Nuevo Producto</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <!-- Nombre Producto -->
                    <x-form-field>
                        <x-form-label for="nombre_producto">Nombre Producto <span
                                class="text-blue-500">(requerido)</span></x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="nombre_producto" id="nombre_producto"
                                :value="old('nombre_producto')"></x-form-input>
                        </div>
                        <x-form-error name="nombre_producto"></x-form-error>
                    </x-form-field>

                    <!-- Categoría -->
                    <x-form-field>
                        <x-form-label for="categoria">Categoría <span
                                class="text-blue-500">(requerido)</span></x-form-label>
                        <x-form-select>
                            @foreach ($categorias->all() as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ old('categoria') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre_categoria }}</option>
                            @endforeach
                        </x-form-select>
                    </x-form-field>

                    <!-- Precio -->
                    <x-form-field>
                        <x-form-label for="precio">Precio <span class="text-blue-500">(requerido)</span></x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="precio" id="precio" :value="old('precio')"></x-form-input>
                        </div>
                        <x-form-error name="precio"></x-form-error>
                    </x-form-field>

                    <!-- Stock Actual -->
                    <x-form-field>
                        <x-form-label for="stock_actual">Stock Actual</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="stock_actual" id="stock_actual" :value="old('stock_actual')"
                                min="0"></x-form-input>
                        </div>
                        <x-form-error name="stock_actual"></x-form-error>
                    </x-form-field>

                    <!-- Descripción -->
                    <x-form-field>
                        <x-form-label for="descripcion">Descripción</x-form-label>
                        <div class="mt-2">
                            <x-form-textarea type="text" name="descripcion" id="descripcion">
                                {{ old('descripcion') }} </x-form-textarea>
                        </div>
                    </x-form-field>

                    <!-- Imagen -->
                    <x-form-field>
                        <x-form-label for="imagen">Imagen del producto</x-form-label>

                        <div class="mt-2">
                            <x-form-input-image></x-form-input-image>
                        </div </x-form-field>


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

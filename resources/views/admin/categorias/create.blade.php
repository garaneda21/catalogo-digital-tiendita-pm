<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header="Crear nueva categoría">
        <flux:button href="/admin/categorias" icon="arrow-left"
            class="dark:text-black! dark:bg-white! hover:bg-gray-200! rounded-3xl!">
            Volver
        </flux:button>
    </x-panel.header>

    <form method="post" action="/admin/categorias">
        @csrf
        <div class="flex flex-col gap-6 max-w-lg mt-6">
            <p class="text-melocoton">Rellena los datos para crear tu nueva categoría</p>

            <!-- Nombre Categoría -->
            <flux:input name="nombre_categoria" label="Nombre Categoria (*)" type="text" autofocus
                :value="old('nombre_categoria')" />

            <!-- Descripción Categoría -->
            <flux:textarea name="descripcion_categoria" label="Descripción Categoria" id="descripcion_categoria">
                {{ old('descripcion_categoria') }}
            </flux:textarea> 

            @if ($errors->any())
                <x-forms.error-card></x-forms.error-card>
            @endif

            <hr>

            <div class="flex items-center justify-end gap-x-6">
                <flux:button type="submit" variant="primary" icon="squares-plus"
                    class="bg-verde-oliva hover:bg-verde-oliva/70! dark:text-black! dark:bg-white! rounded-3xl!">
                    Crear Categoría
                </flux:button>
            </div>
        </div>
    </form>
</x-layouts.app>
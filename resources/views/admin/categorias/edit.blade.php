<x-layouts.app :title="__('Dashboard')">

    <x-panel.header nombre_header="Editar categoría">
        <flux:button href="/admin/categorias" icon="arrow-left"
            class="dark:text-black! dark:bg-white! hover:bg-gray-200! rounded-3xl!">
            Volver
        </flux:button>
    </x-panel.header>

    <form method="POST" enctype="multipart/form-data" action="{{ route('categorias.update', $categoria->id) }}">
        @csrf
        @method('PUT')

        <div class="flex flex-col gap-6 max-w-lg mt-6">
            <p class="text-melocoton">Edita los campos que quieras modificar</p>

            <!-- Nombre Producto -->
            <flux:input name="nombre_categoria" label="Nombre Categoria (*)" type="text" autofocus
                value="{{ $categoria->nombre_categoria }}" />

            <!-- Descripción -->
            <flux:textarea label="Descripción de Categoría" name="descripcion" id="descripcion" >
                {{ $categoria->descripcion_categoria }}
            </flux:textarea>

            @if ($errors->any())
                <x-forms.error-card></x-forms.error-card>
            @endif

            <hr>

            <div class="flex items-center justify-end gap-x-6">
                <flux:button type="submit" variant="primary" icon="arrow-path"
                    class="bg-verde-oliva hover:bg-verde-oliva/70! dark:text-black! dark:bg-white! rounded-3xl!">
                    Actualizar
                </flux:button>
            </div>
        </div>
    </form>


</x-layouts.app>

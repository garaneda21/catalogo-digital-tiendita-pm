<x-layouts.navlist-show-admins :admin="$admin">


    <form method="POST" action="{{ route('administradores.update', $admin->id) }}">
        @csrf
        @method('PUT')

        <div class="flex flex-col gap-6 max-w-lg mt-6">
            <!-- Nombre -->
            <flux:input name="nombre_admin" label="Nombre del administrador" type="text" autofocus
                placeholder="Nombre completo" value="{{ $admin->nombre_admin }}" />

            <!-- Correo -->
            <flux:input name="correo_admin" label="Correo" type="email" placeholder="email@ejemplo.com"
                value="{{ $admin->correo_admin }}" />

            @if ($errors->any())
                <x-forms.error-card/>
            @endif

            <div class="flex items-center justify-end gap-x-6">
                <flux:button type="submit" variant="primary" icon="user-plus"
                    class="bg-verde-oliva hover:bg-verde-oliva/70! dark:text-black! dark:bg-white! rounded-3xl!">Editar</flux:button>
            </div>
        </div>
    </form>

</x-layouts.navlist-show-admins>

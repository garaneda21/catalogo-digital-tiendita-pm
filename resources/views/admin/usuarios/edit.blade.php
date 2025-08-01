<x-layouts.navlist-show-users :usuario="$usuario">


    <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
        @csrf
        @method('PUT')

        <div class="flex flex-col gap-6 max-w-lg mt-6">
            <!-- Nombre -->
            <flux:input name="name" label="Nombre del usuario" autofocus
                placeholder="Nombre completo" value="{{ $usuario->name }}" />

            <!-- Correo -->
            <flux:input name="email" label="Correo" type="email" placeholder="email@ejemplo.com"
                value="{{ $usuario->email }}" />

            @if ($errors->any())
                <x-forms.error-card/>
            @endif

            <div class="flex items-center justify-end gap-x-6">
                <flux:button type="submit" variant="primary" icon="user-plus"
                    class="bg-verde-oliva hover:bg-verde-oliva/70! dark:text-black! dark:bg-white! rounded-3xl!">Editar</flux:button>
            </div>
        </div>
    </form>

</x-layouts.navlist-show-users>

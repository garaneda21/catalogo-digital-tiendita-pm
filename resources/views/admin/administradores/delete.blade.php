<x-layouts.navlist-show-admins :admin="$admin">

    @if (session('failure'))
        <x-mensaje-accion icon="x-circle" variant="danger" heading="{{ session('failure') }}" />
    @endif

    <h2 class="text-2xl font-bold text-[#3D3C63] mb-2">Eliminar este administrador</h2>
    <p class="text-melocoton mb-4">Pulse el botón para eliminar este administrador</p>

    <flux:modal.trigger name="edit-profile">
        <flux:button class="mt-10" variant='danger'>Eliminar Administrador Permanentemente</flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-profile" class="w-96 md:w-125">
        <form method="POST" action="{{ route('administradores.destroy', $admin->id) }}">
            @csrf
            @method('DELETE')

            <div class="space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-center text-[#3D3C63] mb-4">¿Seguro que quieres eliminar este
                        Administrador?</h2>
                    <p class="text-melocoton mb-4 font-semibold">Esta cambio es irreversible.</p>
                    <p class="text-melocoton mb-4 font-semibold">Para confirmar que quieres eliminiar este
                        administrador, escribe su nombre exacto en el siguiente campo:</p>
                </div>

                <flux:input name="nombre_admin" label="Nombre del administrador" autofocus
                    placeholder="{{ $admin->nombre_admin }}" />

                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="danger">Confirmar</flux:button>
                </div>
            </div>
        </form>
    </flux:modal>
</x-layouts.navlist-show-admins>

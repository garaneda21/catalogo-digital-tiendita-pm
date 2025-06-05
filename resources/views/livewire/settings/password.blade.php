<flux:main>
    <div class="bg-white dark:bg-azul-oscuro shadow-xl rounded-2xl p-8 px-20 border dark:border-gray-700 min-h-full">   
        <section class="w-full">
            @include('partials.settings-heading')
        
            <x-settings.layout :heading="__('Actualizar contraseña')" :subheading="__('Asegúrate que tu cuenta esté usando una contraseña segura')">
                <form wire:submit="updatePassword" class="mt-6 space-y-6">
                    <flux:input
                        wire:model="current_password"
                        :label="__('Contraseña actual')"
                        type="password"
                        required
                        autocomplete="contraseña-actual"
                    />
                    <flux:input
                        wire:model="password"
                        :label="__('Nueva contraseña')"
                        type="password"
                        required
                        autocomplete="nueva-contraseña"
                    />
                    <flux:input
                        wire:model="password_confirmation"
                        :label="__('Confirmar nueva contraseña')"
                        type="password"
                        required
                        autocomplete="nueva-contraseña"
                    />
                
                    <div class="flex items-center gap-4">
                        <div class="flex items-center justify-end">
                            <flux:button variant="primary" type="submit" class="w-full">{{ __('Guardar cambios') }}</flux:button>
                        </div>
                    
                        <x-action-message class="me-3" on="password-updated">
                            {{ __('La contraseña ha sido actualizada.') }}
                        </x-action-message>
                    </div>
                </form>
            </x-settings.layout>
        </section>
    </div>
</flux:main>

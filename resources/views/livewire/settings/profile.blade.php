<flux:main>
    <div class="bg-white dark:bg-azul-oscuro shadow-xl rounded-2xl p-8 px-20 border dark:border-gray-700 min-h-full">
        <section class="w-full">
            @include('partials.settings-heading')
        
            <x-settings.layout :heading="__('Perfil')" :subheading="__('Actualiza tu nombre y dirección de correo electrónico')">
                <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
                    <flux:input wire:model="name" :label="__('Nombre')" type="text" required autofocus autocomplete="name" />
                
                    <div>
                        <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />
                    
                        @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                            <div>
                                <flux:text class="mt-4">
                                    {{ __('Tu correo no está verificado.') }}
                            
                                    <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                        {{ __('Clickea aquí para re-enviar email de verificación.') }}
                                    </flux:link>
                                </flux:text>
                            
                                @if (session('status') === 'verification-link-sent')
                                    <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                        {{ __('Un nuevo link de verificación ha sido enviado a tu correo electrónico.') }}
                                    </flux:text>
                                @endif
                            </div>
                        @endif
                    </div>
                
                    <div class="flex items-center gap-4">
                        <div class="flex items-center justify-end">
                            <flux:button variant="primary" type="submit" class="w-full">{{ __('Guardar cambios') }}</flux:button>
                        </div>
                    
                        <x-action-message class="me-3" on="profile-updated">
                            {{ __('Se han guardado los cambios.') }}
                        </x-action-message>
                    </div>
                </form>
            
                <livewire:settings.delete-user-form />
            </x-settings.layout>
        </section>
    </div>
</flux:main>

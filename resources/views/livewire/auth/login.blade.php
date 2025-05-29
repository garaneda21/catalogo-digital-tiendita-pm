<div class="flex flex-col gap-6">
    <div>
        <h2 class="pb-1 text-3xl font-bold text-azul-profundo dark:text-white text-center">Iniciar Sesión</h2>
        <p class="text-sm text-azul-profundo dark:text-gray-300 text-center">Ingresa tu email y contraseña para ingresar
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input wire:model="email" :label="__('Correo Electrónico')" type="email" required autofocus
            autocomplete="email" placeholder="email@example.com" />

        <!-- Password -->
        <div class="relative">
            <flux:input wire:model="password" :label="__('Contraseña')" type="password" required
                autocomplete="current-password" viewable />
            @if (Route::has('password.request'))
                <flux:link class="absolute end-0 top-0 text-sm text-melocoton" :href="route('password.request')"
                    wire:navigate>
                    {{ __('¿Olvidaste tu contraseña?') }}
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox class="text-azul-profundo dark:text-white" wire:model="remember" :label="__('Recordarme')" />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit"
                class="w-full text-white bg-verde-oliva hover:bg-verde-oliva/70">{{ __('Iniciar sesión') }}
            </flux:button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-azul-profundo text-center text-sm dark:text-white">
            {{ __('¿No tienes cuenta?') }}
            <flux:link class="text-melocoton" :href="route('register')" wire:navigate>{{ __('Regístrate Aquí') }}
            </flux:link>
        </div>
    @endif
</div>

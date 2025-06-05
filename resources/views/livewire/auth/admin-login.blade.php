<div class="flex flex-col gap-6">
    <div>
        <h2 class="pb-4 text-3xl font-bold text-azul-profundo dark:text-white text-center">Iniciar sesión como Administrador</h2>
        <p class="text-sm text-azul-profundo dark:text-gray-300 text-center">Ingresa tu email y contraseña para ingresar
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <div>
            <label class="text-azul-profundo dark:text-white font-bold text-sm">Correo Electrónico</label>
            <flux:input wire:model="correo_admin" :label="__('')" type="email" required autofocus autocomplete="email"
                placeholder="email@example.com" />
        </div>

        <!-- Password -->
        <div class="relative">
            <div>
                <label class="text-azul-profundo dark:text-white font-bold text-sm">Contraseña</label>
                <flux:input wire:model="password" :label="__('')" type="password" required
                    autocomplete="current-password" viewable />
                @if (Route::has('password.request'))
                    <flux:link class="absolute end-0 top-0 text-sm text-melocoton" :href="route('password.request')"
                        wire:navigate>
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </flux:link>
                @endif
            </div>
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit"
                class="w-full text-white bg-verde-oliva hover:bg-verde-oliva/70">{{ __('Iniciar sesión') }}</flux:button>
        </div>
    </form>
</div>

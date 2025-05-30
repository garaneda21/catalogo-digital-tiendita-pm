<div class="flex flex-col gap-6">
    <div>
        <h2 class="pb-1 text-3xl font-bold text-azul-profundo dark:text-white text-center">Crea tu cuenta</h2>
        <p class="text-sm text-azul-profundo dark:text-gray-300 text-center">Ingresa los detalles para crear tu cuenta 🧡
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input wire:model="name" :label="__('Nombre completo')" type="text" required autofocus autocomplete="name"
            :placeholder="__('Full name')" />

        <!-- Email Address -->
        <flux:input wire:model="email" :label="__('Correo')" type="email" required autocomplete="email"
            placeholder="email@ejemplo.com" />

        <!-- Password -->
        <flux:input wire:model="password" :label="__('Contraseña')" type="password" required autocomplete="new-password"
            viewable />

        <!-- Confirm Password -->
        <flux:input wire:model="password_confirmation" :label="__('Confirmar contraseña')" type="password" required
            autocomplete="new-password" viewable />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary"
                class="w-full text-white bg-verde-oliva hover:bg-verde-oliva/70">
                {{ __('Crear cuenta') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-azul-profundo dark:text-white">
        {{ __('¿Ya tienes una cuenta?') }}
        <flux:link class="text-melocoton" :href="route('login')" wire:navigate>{{ __('Inicia sesión') }}</flux:link>
    </div>
</div>

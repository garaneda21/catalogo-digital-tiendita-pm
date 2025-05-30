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
        <div>
            <label class="text-azul-profundo dark:text-white font-bold text-sm">Nombre Completo</label>
            <flux:input wire:model="name" :label="__('')" type="text" required autofocus autocomplete="name"
                :placeholder="__('Full name')" />
        </div>

        <!-- Email Address -->
        <div>
            <label class="text-azul-profundo dark:text-white font-bold text-sm">Dirección de correo</label>
            <flux:input wire:model="email" :label="__('')" type="email" required autocomplete="email"
                placeholder="email@ejemplo.com" />
        </div>

        <!-- Password -->
        <div>
            <label class="text-azul-profundo dark:text-white font-bold text-sm">Contraseña</label>
            <flux:input wire:model="password" :label="__('')" type="password" required
                autocomplete="new-password" viewable />
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="text-azul-profundo dark:text-white font-bold text-sm">Confirmar contraseña</label>
            <flux:input wire:model="password_confirmation" :label="__('')" type="password" required
                autocomplete="new-password" viewable />
        </div>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full text-white bg-verde-oliva hover:bg-verde-oliva/70">
                {{ __('Crear cuenta') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-azul-profundo dark:text-white">
        {{ __('¿Ya tienes una cuenta?') }}
        <flux:link class="text-melocoton" :href="route('login')" wire:navigate>{{ __('Inicia sesión') }}</flux:link>
    </div>
</div>

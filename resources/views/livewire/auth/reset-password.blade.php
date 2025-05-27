<div class="flex flex-col gap-6">
    <div>
        <h2 class="pb-1 text-3xl font-bold text-azul-profundo dark:text-white text-center">Restablecer Contraseña</h2>
        <p class="text-sm text-azul-profundo dark:text-gray-300 text-center">Ingresa tu nueva contraseña</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="resetPassword" class="flex flex-col gap-6">
        <!-- Email Address -->
        <div>
            <label class="text-azul-profundo dark:text-white font-bold text-sm">Correo electrónico</label>
            <flux:input
                wire:model="email"
                type="email"
                required
                autocomplete="email"
            />
        </div>

        <!-- Password -->
        <div>
            <label class="text-azul-profundo dark:text-white font-bold text-sm">Nueva contraseña</label>
            <flux:input
                wire:model="password"
                type="password"
                required
                autocomplete="new-password"
                viewable
            />
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="text-azul-profundo dark:text-white font-bold text-sm">Confirmar contraseña</label>
            <flux:input
                wire:model="password_confirmation"
                type="password"
                required
                autocomplete="new-password"
                viewable
            />
        </div>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full text-white bg-verde-oliva hover:bg-verde-oliva/70">
                {{ __('Reset password') }}
            </flux:button>
        </div>
    </form>
</div>

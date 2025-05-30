 <div class="flex flex-col gap-6">
     <div>
         <h2 class="pb-1 text-3xl font-bold text-azul-profundo dark:text-white text-center">Contraseña olvidada</h2>
         <p class="text-sm text-azul-profundo dark:text-gray-300 text-center">Ingresa tu email para recibir un link de
             reseteo de contraseña</p>
     </div>

     <!-- Session Status -->
     <x-auth-session-status class="text-center" :status="session('status')" />

     <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
         <!-- Email Address -->
         <div>
             <label class="text-azul-profundo dark:text-white font-bold text-sm">Correo Electrónico</label>
             <flux:input wire:model="email" :label="__('')" type="email" required autofocus
                 placeholder="email@example.com" viewable />
         </div>

         <flux:button variant="primary" type="submit" class="w-full text-white bg-verde-oliva hover:bg-verde-oliva/70">{{ __('Enviar link de reinicio a tu correo') }}
         </flux:button>
     </form>

     <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-azul-profundo dark:text-white">
         {{ __('De lo contrario, regresa a') }}
         <flux:link class="text-melocoton" :href="route('login')" wire:navigate>{{ __('Inicio de sesión') }}</flux:link>
     </div>
 </div>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-crema-claro dark:bg-gris-oscuro">
        <flux:sidebar sticky stashable class="rounded-tr-2xl rounded-br-2xl border-e border-zinc-200 bg-verde-oliva dark:border-gray-700 dark:bg-azul-oscuro">

            <flux:sidebar.toggle class="lg:hidden text-white!" icon="x-mark" />

                <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                    <x-app-logo />
                </a>

                <flux:navlist class="w-auto">
                    <flux:navlist.item class="text-white! hover:text-black! data-current:bg-black/25! data-current:hover:bg-white!" href="/admin/productos" icon="squares-2x2">Productos</flux:navlist.item>
                    <flux:navlist.item class="text-white! hover:text-black! data-current:bg-black/25! data-current:hover:bg-white!" href="/admin/categorias" icon="tag">Categorías</flux:navlist.item>
                    <flux:navlist.item class="text-white! hover:text-black! data-current:bg-black/25! data-current:hover:bg-white!" href="/admin/administradores" icon="key">Administradores</flux:navlist.item>
                    <flux:navlist.item class="text-white! hover:text-black! data-current:bg-black/25! data-current:hover:bg-white!" href="/admin/usuarios" icon="user-group">Usuarios</flux:navlist.item>
                </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item class="text-white!" icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item class="text-white!" icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>

            <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                <flux:radio value="light" icon="sun"/>
                <flux:radio value="dark" icon="moon"/>
                <flux:radio value="system" icon="computer-desktop" />
            </flux:radio.group>

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->nombre_admin"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                    circle
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->nombre_admin }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->correo_admin }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout-admin') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Cerrar Sesión') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden bg-verde-oliva">
            <flux:sidebar.toggle class="lg:hidden text-white!" icon="bars-3" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->nombre_admin }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->correo_admin }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout-admin') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Cerrar Sesión') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>

@props([
    'expandable' => false,
    'expanded' => true,
    'heading' => null,
])

<?php if ($expandable && $heading): ?>
    <ui-disclosure {{ $attributes->class('group/disclosure') }} @if ($expanded === true) open @endif data-flux-navlist-group>
        <button type="button" class="w-full h-12 lg:h-10 flex items-center group/disclosure-button mb-[2px] rounded-lg hover:bg-white text-white hover:text-black">
            <div class="ps-3 pe-4">
                <flux:icon.chevron-down class="size-4! hidden group-data-open/disclosure-button:block" />
                <flux:icon.chevron-right class="size-4! block group-data-open/disclosure-button:hidden" />
            </div>

            <span class="text-md font-medium leading-none">{{ $heading }}</span>
        </button>

        <div class="relative hidden data-open:block space-y-[2px] ps-7" @if ($expanded === true) data-open @endif>
            <div class="absolute inset-y-[3px] w-px bg-zinc-200 dark:bg-white/30 start-0 ms-4"></div>

            {{ $slot }}
        </div>
    </ui-disclosure>
<?php elseif ($heading): ?>
    <div {{ $attributes->class('block space-y-[2px]') }}>
        <div class="px-3 py-2">
            <div class="text-md text-zinc-400 font-medium leading-none">{{ $heading }}</div>
        </div>

        <div>
            {{ $slot }}
        </div>
    </div>
<?php else: ?>
    <div {{ $attributes->class('block space-y-[2px]') }}>
        {{ $slot }}
    </div>
<?php endif; ?>

@props([
    'icon' => null,
    'variant' => null,
    'heading' => null,
])

<flux:callout :icon="$icon" :variant="$variant" inline x-data="{ visible: true }" x-show="visible" class="mb-4">
    <flux:callout.heading class="flex gap-2 @max-md:flex-col items-start">
        {{ $heading }}
    </flux:callout.heading>
    <x-slot name="controls">
        <flux:button icon="x-mark" variant="ghost" x-on:click="visible = false" />
    </x-slot>
</flux:callout>

<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        <div class="bg-white dark:bg-azul-oscuro shadow-xl rounded-2xl p-8 border dark:border-gray-700 min-h-full">
            {{ $slot }}
        </div>
    </flux:main>
</x-layouts.app.sidebar>

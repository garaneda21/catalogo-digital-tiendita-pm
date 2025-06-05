<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        <div class="bg-white dark:bg-azul-oscuro shadow-xl rounded-2xl p-8 border dark:border-gray-700 min-h-full">
            {{ $slot }}
        </div>
    </flux:main>

    <!-- Bootstrap para los modales de eliminacion y producto -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-layouts.app.sidebar>

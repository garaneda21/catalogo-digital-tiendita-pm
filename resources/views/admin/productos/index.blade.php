<x-layouts.panel>

    <div class="flex justify-between items-center mb-6">
        <input type="text" placeholder="Buscar..." class="border px-4 py-2 rounded w-1/2">
        <button class="bg-gray-300 p-2 rounded hover:bg-gray-400">☰</button>
    </div>

    <div class="space-y-4">
        @foreach (['producto 1', 'producto 2', 'producto 3'] as $producto)
            <div class="bg-white shadow p-4 rounded flex justify-between items-center mb-4">
                <span>{{ $producto }}</span>
                <button class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                    Editar
                </button>
            </div>
        @endforeach

    </div>

    <div class="mt-6">
        <button class="px-4 py-2 border rounded bg-white hover:bg-gray-100">Anterior</button>
        <button class="px-4 py-2 border rounded bg-white hover:bg-gray-100">Siguiente</button>
    </div>

</x-layouts.panel>

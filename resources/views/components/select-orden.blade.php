<form method="GET" class="mb-4">
    <!-- Input oculto con la búsqueda realizada anteriormente -->
    <input type="hidden" name="search" value="{{ request('search') }}">

    <label for="ordering" class="bloce mb-1 text-sm font-medium text-gray-700">Ordenar por:</label>
    <select name="ordering" id="ordering" onchange="this.form.submit()"
        class="block bg-[#587A6C] text-[#F7F5F2] w-full max-w-xs px-3 py-2 rounded-2xl shadow-sm focus:outline focus:ring-blue-500 focus:border-blue-500 text-sm">
        <option value="">-- Seleccionar --</option>
        {{ $slot }}
    </select>
</form>

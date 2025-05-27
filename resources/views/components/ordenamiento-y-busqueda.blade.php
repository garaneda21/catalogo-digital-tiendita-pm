<form class="mb-6 w-full">
    <label for="ordering" class="block mb-2 text-sm font-medium text-gray-700">
        Ordenar por:
    </label>

    <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
        {{-- Selector de ordenamiento --}}
        <div class="w-full md:w-1/2 mb-2 md:mb-0">
            <select name="ordering" id="ordering" onchange="this.form.submit()"
                class="w-full bg-[#587A6C] text-[#F7F5F2] px-3 py-2 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                <option value="">-- Seleccionar --</option>
                <option value="recientes" {{ request('ordering') == 'recientes' ? 'selected' : '' }}>Añadidos Recientemente</option>
                <option value="nombre_asc" {{ request('ordering') == 'nombre_asc' ? 'selected' : '' }}>Nombre (A-Z)</option>
                <option value="nombre_desc" {{ request('ordering') == 'nombre_desc' ? 'selected' : '' }}>Nombre (Z-A)</option>
                <option value="precio_asc" {{ request('ordering') == 'precio_asc' ? 'selected' : '' }}>Precio (menor a mayor)</option>
                <option value="precio_desc" {{ request('ordering') == 'precio_desc' ? 'selected' : '' }}>Precio (mayor a menor)</option>
            </select>
        </div>

        {{-- Barra de búsqueda + botón --}}
        <div class="w-full md:w-1/2 flex">
            <input type="text" name="search" placeholder="Buscar producto..." value="{{ request('search') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
            <button type="submit"
                class="px-4 py-2 bg-[#587A6C] text-[#F7F5F2] text-sm rounded-r-md hover:bg-[#3D3C63] transition">
                Buscar
            </button>
        </div>
    </div>
</form>

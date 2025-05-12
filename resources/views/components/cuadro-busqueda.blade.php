<div class="py-4 mx-auto">
    <form class="flex w-full">
        <input type="text" name="search" placeholder="Buscar producto..." value="{{ request('search') }}"
            class="flex-grow px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" />
        <button type="submit"
            class="px-4 py-2 bg-[#587A6C] text-[#F7F5F2] text-sm rounded-r-md hover:bg-blue-700 transition">
            Buscar
        </button>
    </form>
</div>

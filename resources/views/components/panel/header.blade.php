@props(['nombre_header' => 'HEADER'])

<div class="flex justify-between items-center pb-4">
    <h1 class="text-3xl font-bold text-azul-profundo dark:text-white">{{ $nombre_header }}</h1>
    {{ $slot }}
</div>

<hr>

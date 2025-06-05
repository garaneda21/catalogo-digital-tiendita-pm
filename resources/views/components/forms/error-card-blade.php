<div class="mt-4 flex items-start gap-3 rounded-lg border border-red-300 bg-red-100 p-4 text-red-800">
    <!-- Icono redondo de advertencia -->
    <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-red-200">
        <svg class="h-5 w-5 text-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path
                d="M23.64,18.1L14.24,2.28c-.47-.8-1.3-1.28-2.24-1.28s-1.77,.48-2.23,1.28L.36,18.1h0c-.47,.82-.47,1.79,0,2.6s1.31,1.3,2.24,1.3H21.41c.94,0,1.78-.49,2.24-1.3s.46-1.78-.01-2.6Zm-10.64-.1h-2v-2h2v2Zm0-4h-2v-6h2v6Z" />
        </svg>
    </div>

    <!-- Texto de error -->
    <div class="flex-1">
        <p class="font-semibold">Se encontraron errores en el formulario.</p>
        <ul class="mt-1 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
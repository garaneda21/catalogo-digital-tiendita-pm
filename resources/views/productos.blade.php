<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Productos</title>
        <link href="css/style.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-3xl font-bold mb-6">Todos los Productos</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                {{-- Producto 1 --}}
                <div class="bg-brown rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Imagen</span>
                    </div>
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800">Perfume Rosa</h2>
                        <p class="text-sm text-gray-600">Perfumería</p>
                        <p class="text-xl font-bold text-pink-600 mt-2">$49.99</p>
                        <p class="text-sm text-gray-500 mt-2">Un aroma floral suave perfecto para el día a día.</p>
                    </div>
                </div>

                {{-- Producto 2 --}}
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Imagen</span>
                    </div>
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800">Collar Dorado</h2>
                        <p class="text-sm text-gray-600">Accesorios</p>
                        <p class="text-xl font-bold text-pink-600 mt-2">$29.00</p>
                        <p class="text-sm text-gray-500 mt-2">Elegante y minimalista, ideal para toda ocasión.</p>
                    </div>
                </div>

                {{-- Producto 3 --}}
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Imagen</span>
                    </div>
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800">Blusa Blanca</h2>
                        <p class="text-sm text-gray-600">Ropa</p>
                        <p class="text-xl font-bold text-pink-600 mt-2">$39.95</p>
                        <p class="text-sm text-gray-500 mt-2">Blusa fresca con detalles en encaje.</p>
                    </div>
                </div>

                {{-- Producto 4 --}}
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Imagen</span>
                    </div>
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800">Set de Brochas</h2>
                        <p class="text-sm text-gray-600">Maquillaje</p>
                        <p class="text-xl font-bold text-pink-600 mt-2">$24.50</p>
                        <p class="text-sm text-gray-500 mt-2">Juego de brochas profesionales de alta calidad.</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

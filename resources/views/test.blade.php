
<!-- Deja aquí algún código HTML que quieras probar 👀 -->
<!-- Deja aquí algún código HTML que quieras probar 👀 -->
<!-- Deja aquí algún código HTML que quieras probar 👀 -->

<!-- Y luevo vé a la ruta /test -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Test</title>
        @vite('resources/css/app.css')
    </head>
    <body>

    </body>
</html>
<div class="min-h-screen bg-[#FDF9F2] flex items-center justify-center px-4">
    <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md space-y-6">
        <h2 class="text-2xl font-bold text-[#3D3C63] text-center">Iniciar Sesión</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-[#3D3C63]">Correo electrónico</label>
                <input id="email" name="email" type="email" required autofocus
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#D6866B] focus:border-[#D6866B] text-sm" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-[#3D3C63]">Contraseña</label>
                <input id="password" name="password" type="password" required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#D6866B] focus:border-[#D6866B] text-sm" />
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="remember" class="rounded text-[#587A6C]" />
                    <span class="text-[#3D3C63]">Recordarme</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-[#D6866B] hover:underline">¿Olvidaste tu contraseña?</a>
            </div>

            <button type="submit"
                class="w-full bg-[#587A6C] text-white py-2 rounded-md hover:bg-[#3D3C63] transition">
                Ingresar
            </button>
        </form>

        <p class="text-center text-sm text-[#3D3C63]">¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-[#D6866B] hover:underline">Regístrate aquí</a>
        </p>
    </div>
</div>



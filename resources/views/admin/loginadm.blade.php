@extends('components.layouts.auth.card')

@section('title', 'Acceso Administrador')

@section('content')
    <h1 class="text-2xl font-bold text-center font-serif">Panel de Administración</h1>

    @if ($errors->any())
        <div class="p-4 bg-red-100 border border-red-400 text-red-700 rouded text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4 mt-4">
        @csrf
        <x-form-field>
            <x-form-label for="usuario">Usuario</x-form-label>
            <x-form-input
                id="usuario"
                name="usuario"
                type="text"
                required
                autocomplete="off"
                placeholder="Ingrese su usuario"
            />
        </x-form-field>

        <x-form-field>
            <x-form-label for="password">Contraseña</x-form-label>
            <x-form-input
                id="password"
                name="password"
                type="password"
                required
                autocomplete="off"
            />
        </x-form-field>

        <div>
            <button type="submit" class="w-full bg-zinc-800 hover:bg-zinc-900 text-white font-medium py-2 rounded-lg transition duration-200">
                Iniciar Sesión
            </button>
        </div>
    </form>
@endsection
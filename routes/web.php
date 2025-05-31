<?php

use App\Http\Controllers\CategoriaUserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoUserController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

// Vista de prueba
Route::view('/test', 'test');

// Vistas principales
Route::view('/', 'inicio')->name('inicio');
Route::redirect('admin', 'admin/productos');

// Vista Productos Clientes
Route::get('/productos', [ProductoUserController::class, 'index']);
Route::get('/productos/categorias/{categoria}', [CategoriaUserController::class, 'index']);
Route::get('/productos/{id}', [ProductoUserController::class, 'show']);

// Rutas a las que solo puede acceder el admin
Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::resource('admin/productos', ProductoController::class);
});

// LARAVEL

Route::get('/home', function () {
    return view('welcome');
})->name('home');
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth:web'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';

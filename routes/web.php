<?php

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AdministradoresController;
use App\Http\Controllers\CategoriaUserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovimientosController;
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
Route::redirect('admin', 'admin/dashboard');

// Vista Productos Clientes
Route::get('/productos', [ProductoUserController::class, 'index']);
Route::get('/productos/categorias/{categoria}', [CategoriaUserController::class, 'index']);
Route::get('/productos/{id}', [ProductoUserController::class, 'show']);

// Rutas a las que solo puede acceder el admin
Route::middleware(['auth:admin', 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', DashboardController::class);

    Route::resource('/productos', ProductoController::class);
    Route::resource('/categorias', CategoriaController::class);

    Route::get('/administradores/{administrador}/edit-permisos', [AdministradoresController::class, 'edit_permisos']);
    Route::put('/administradores/{administrador}/update-permisos', [AdministradoresController::class, 'update_permisos'])
        ->name('administradores.update-permisos');
    Route::get('/administradores/{administrador}/historial', [AdministradoresController::class, 'index_historial'])
        ->name('administradores.historial');
    Route::resource('/administradores', AdministradoresController::class)
        ->parameters(['administradores' => 'administrador']);

    Route::resource('/usuarios', UsuariosController::class)
        ->parameters(['administradores' => 'administrador']);
    Route::delete('/usuarios/{usuario}', [UsuariosController::class, 'destroy'])
        ->name('usuarios.destroy');

    Route::get('/movimientos/salida/{producto}/create-venta', [MovimientosController::class, 'create_venta']);
    Route::post('/movimientos/salida/{producto}', [MovimientosController::class, 'store_venta']);

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

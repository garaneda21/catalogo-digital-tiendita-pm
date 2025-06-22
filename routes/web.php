<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CarritoController;
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
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
Route::middleware(['auth:admin', 'verified', 'can:admin-activo'])->prefix('admin')->group(function () {
    Route::get('/dashboard', DashboardController::class);

    // Rutas de Productos
    Route::resource('/productos', ProductoController::class);
    Route::get('/productos/{producto}/disable', [ProductoController::class, 'disable']);
    Route::resource('/categorias', CategoriaController::class);


    // Rutas de Admins
    Route::get('/administradores/{administrador}/edit-permisos', [AdministradoresController::class, 'edit_permisos']);
    Route::put('/administradores/{administrador}/update-permisos', [AdministradoresController::class, 'update_permisos'])
        ->name('administradores.update-permisos');
    Route::get('/administradores/{administrador}/historial', [AdministradoresController::class, 'index_historial'])
        ->name('administradores.historial');
    Route::get('/administradores/{administrador}/disable', [AdministradoresController::class, 'disable'])
        ->name('administradores.disable');
    Route::get('/administradores/{administrador}/delete', [AdministradoresController::class, 'delete'])
        ->name('administradores.delete');
    Route::resource('/administradores', AdministradoresController::class)
        ->parameters(['administradores' => 'administrador']);


    Route::resource('/usuarios', UsuariosController::class)
        ->parameters(['administradores' => 'administrador']);
    Route::delete('/usuarios/{usuario}', [UsuariosController::class, 'destroy'])
        ->name('usuarios.destroy');


    Route::get('/movimientos', [MovimientosController::class, 'index']);

    Route::get('/movimientos/salida/{producto}/create-venta', [MovimientosController::class, 'create_venta']);
    Route::post('/movimientos/salida/{producto}', [MovimientosController::class, 'store_venta']);


    Route::get('/movimientos/entrada/{producto}/create-stock', [MovimientosController::class, 'create_stock']);
    Route::post('/movimientos/entrada/{producto}', [MovimientosController::class, 'store_stock']);
});

// Rutas de carrito de compras, parece que estas no se usaran xddd
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::post('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

// Rutas API para el carrito de compras, especial para modal de carrito
Route::prefix('api/carrito')->group(function () {
    Route::post('agregar/{producto}', [CarritoController::class, 'apiAgregar']);
    Route::put('actualizar/{item}', [CarritoController::class, 'apiActualizarCantidad']);
    Route::delete('eliminar/{item}', [CarritoController::class, 'apiEliminar']);
});

// Rutas de checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');


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

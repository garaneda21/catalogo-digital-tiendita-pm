<?php

use App\Http\Controllers\AdministradoresController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CategoriaUserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\MovimientosController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoUserController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\WebpayController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

// Vista de prueba
Route::view('/test', 'test');

// Vistas principales
Route::get('/', InicioController::class)->name('inicio');

Route::redirect('admin', 'admin/dashboard');

// Vista Productos Clientes
Route::get('/productos', [ProductoUserController::class, 'index']);
Route::get('/productos/categorias/{slug}', [CategoriaUserController::class, 'index']);
Route::get('/productos/{slug}', [ProductoUserController::class, 'show']);

// Rutas a las que solo puede acceder el admin
Route::middleware(['auth:admin', 'verified', 'can:admin-activo'])->prefix('admin')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

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

// Rutas para el carrito de compras
Route::controller(CarritoController::class)->group(function () {
    Route::get('/carrito', 'index')->name('carrito.index'); // Muestra el carrito
    Route::post('/carrito/agregar', 'add')->name('carrito.add');    // Agrega un item al carrito
    Route::patch('/carrito/actualizar/{itemId}', 'update')->name('carrito.update'); // Actualiza un item del carrito
    Route::delete('/carrito/eliminar/{itemId}', 'remove')->name('carrito.remove');  // Elimina un item del carrito
    Route::post('/carrito/vaciar', 'clear')->name('carrito.clear'); // Vacía todo el carrito
});
Route::get('/carrito/contenido', [CarritoController::class, 'contenido'])->name('carrito.contenido');
Route::get('/carrito/cantidad', [CarritoController::class, 'cantidad'])->name('carrito.cantidad');


// Rutas de checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/pagar', [CheckoutController::class, 'pagar'])->name('checkout.pagar');
Route::get('/checkout/error', function () {
    return view('checkout.error', [
        'mensaje' => 'Pago cancelado o no autorizado.',
    ]);
})->name('checkout.error');

// Rutas de Webpay
Route::post('/webpay/iniciar', [WebpayController::class, 'iniciarPago'])->name('webpay.iniciar');
Route::match(['get', 'post'], '/webpay/respuesta', [WebpayController::class, 'respuestaPago'])->name('webpay.respuesta');

// LARAVEL

Route::middleware(['auth:web'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categorias = Categoria::all();
    return view('inicio', compact('categorias'));
})->name('inicio');

Route::view('/test', 'test');

Route::redirect('admin', 'admin/productos');
Route::resource('admin/productos', ProductoController::class);

// Administrar Categorías
Route::resource('admin/categorias', CategoriaController::class);

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';

Route::get('/{categoria}', function ($categoria, Request $request) {
    // TODO: Estoy reciclando mucho código xd, pendiente encontrar mejor forma de obtener todos los productos

    $categorias = Categoria::where('nombre_categoria', $categoria)->first();

    if (! $categorias) {
        abort(404);
    }

    $query = Producto::with('categoria')->where('categoria_id', $categorias->id);

    if ($request->has('search')) {
        $query->where('nombre_producto', 'like', '%'.$request->search.'%');
    }

    // Ordenamiento
    switch ($request->ordering) {
        case 'recientes':
            $query->orderBy('created_at', 'desc');
            break;
        case 'nombre_asc':
            $query->orderBy('nombre_producto', 'asc');
            break;
        case 'nombre_desc':
            $query->orderBy('nombre_producto', 'desc');
            break;
        case 'precio_asc':
            $query->orderBy('precio', 'asc');
            break;
        case 'precio_desc':
            $query->orderBy('precio', 'desc');
            break;
        default:
            $query->orderBy('created_at', 'desc');
            break;
    }

    // Paginación con parámetros persistentes
    $productos = $query->paginate(24)->appends($request->only(['search', 'ordering']));

    return view('productos', compact('productos'));
});

// Ruta para vista en detalle de cada producto
/*
 *    NOTA: Para mejorar posicionamiento web y mejor visibilidad de las URL, se recomienda
 *    usar slug en vez de id para las rutas.
 */
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.show');

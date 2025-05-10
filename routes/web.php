<?php

use App\Http\Controllers\ProductoController;
use App\Models\Categoria;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/inicio');
});

Route::redirect('admin', 'admin/productos');
Route::resource('admin/productos', ProductoController::class);

Route::get('/{categoria}', function ($categoria) {
    $categorias = Categoria::where('nombre_categoria', $categoria)->first();

    if (! $categorias) {
        abort(404);
    }

    return view('productos', [
        'productos' => $categorias->productos()->paginate(24),
    ]);
});

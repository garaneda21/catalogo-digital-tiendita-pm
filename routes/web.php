<?php

use App\Http\Controllers\ProductoController;
use App\Models\Categoria;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/panel', function () {
    $vista = request()->get('vista');
    return view('admin.panel', compact('vista'));
})->name('panel');

Route::resource('producto', ProductoController::class);

Route::get('/{categoria}', function ($categoria) {
    $productos = Categoria::where('nombre_categoria', $categoria)->first();

    if (!$productos) {
        abort(404);
    }

    return view('productos', [
        'productos' => $productos,
    ]);
});


<?php

use App\Models\Categoria;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{categoria}', function ($categoria) {
    $productos = Categoria::where('nombre_categoria', $categoria)->first();

    if (!$productos) {
        abort(404);
    }

    return view('productos', [
        'productos' => $productos,
    ]);
});

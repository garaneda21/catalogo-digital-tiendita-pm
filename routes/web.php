<?php

use App\Http\Controllers\ProductoController;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/inicio');
});

Route::redirect('admin', 'admin/productos');
Route::resource('admin/productos', ProductoController::class);

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
            $query->orderBy('nombre_producto', 'asc'); // orden por defecto
            break;
    }

    // Paginación con parámetros persistentes
    $productos = $query->paginate(24)->appends($request->only(['search', 'ordering']));

    return view('productos', compact('productos'));
});

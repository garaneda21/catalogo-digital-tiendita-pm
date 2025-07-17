<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class CategoriaUserController extends Controller
{
    public function index($slug, Request $request)
    {
        $categoriaSeleccionada = Categoria::where('slug', $slug)->first();

        if (! $categoriaSeleccionada) {
            abort(404);
        }

        $query = Producto::with('categoria')->where('categoria_id', $categoriaSeleccionada->id);

        $productos = Producto::busqueda($request, $query);

        $categorias = Categoria::orderBy('nombre_categoria')->get();

        return view('productos.index', [
            'productos' => $productos,
            'categoria' => $categoriaSeleccionada->nombre_categoria,
            'categorias' => $categorias,
            'slugSeleccionado' => $slug, // indica que hay una categoría seleccionada
        ]);
    }
}

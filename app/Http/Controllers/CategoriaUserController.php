<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class CategoriaUserController extends Controller
{
    public function index($categoria, Request $request)
    {
        $categorias = Categoria::where('nombre_categoria', $categoria)->first();

        if(! $categorias) {
            abort(404);
        }

        $query = Producto::with('categoria')->where('categoria_id', $categorias->id);

        $productos = Producto::busqueda($request, $query);

        return view('productos.index', compact('productos'));
    }
}

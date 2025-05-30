<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Producto::with('categoria');

        //realiza búsqueda y retorna datos paginados
        $productos = Producto::busqueda($request, $query);

        return view('catalogo.index', compact('productos'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::where('id', $id)->firstOrFail();

        return view('producto.show', compact('producto'));
    }
}

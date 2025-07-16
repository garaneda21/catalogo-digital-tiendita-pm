<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
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

        $categorias = Categoria::orderBy('nombre_categoria')->get();

        return view('productos.index', [
            'productos' => $productos,
            'categorias' => $categorias,
            'slugSeleccionado' => null, // indica que no hay categoría seleccionada
        ]);
    }

    /**
     * Display the specified resource.
     * Usado para vista detallada en pagina de producto
     * NOTE: A futuro implementar slug en vez de id para mejorar visualizacion
     * de la url y posicionamiento
     * ej url con id =   producto/15
     * ej url con slug = producto/polera-oversize-blanca
     */
    public function show($slug)
    {
        $producto = Producto::where('slug', $slug)->firstOrFail();

        return view('productos.show', compact('producto'));
    }
}

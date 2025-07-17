<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;


class InicioController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $categorias = Categoria::all();
        $destacados = Producto::where('destacado', true)->latest()->get();
        $nuevos = Producto::latest()->take(10)->get();

        return view('inicio', compact(
            'categorias',
            'destacados',
            'nuevos'
        ));
    }
}

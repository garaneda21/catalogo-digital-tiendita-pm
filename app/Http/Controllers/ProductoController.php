<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_producto' => 'required|max:250',
            'descripcion' => 'nullable',
            'stock_actual' => 'required|integer',
            'precio' => 'required|numeric',
            'imagen_url' => 'nullable|url',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Producto::create([
            'nombre_producto' => $request->nombre_producto,
            'descripcion' => $request->descripcion,
            'stock_actual' => $request->stock_actual,
            'precio' => $request->precio,
            'imagen_url' => $request->imagen_url,
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('admin.productos.index');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre_producto' => 'required|max:250',
            'descripcion' => 'nullable',
            'stock_actual' => 'required|integer',
            'precio' => 'required|numeric',
            'imagen_url' => 'nullable|url',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $producto->update([
            'nombre_producto' => $request->nombre_producto,
            'descripcion' => $request->descripcion,
            'stock_actual' => $request->stock_actual,
            'precio' => $request->precio,
            'imagen_url' => $request->imagen_url,
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('admin.productos.index');
    }
    
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('admin.productos.index');
    }
}

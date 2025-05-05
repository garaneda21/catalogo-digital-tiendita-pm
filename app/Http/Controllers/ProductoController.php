<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        $categorias = Categoria::all();

        return view('productos.create', [
            'categorias' => $categorias,
        ]);
    }

    public function store(Request $request)
    {
        // TODO: Implementar las siguientes validaciones
        // - Producto ya existe

        $request->validate([
            'nombre_producto'  =>  ['required', 'max:250'],
            'categoria'        =>  ['required'],
            'descripcion'      =>  [],
            'stock_actual'     =>  ['gte:0'],
            'precio'           =>  ['required', 'gte:0'],
            // 'imagen_url' => [],
        ]);

        Producto::create([
            'nombre_producto'  =>  request('nombre_producto'),
            'categoria_id'     =>  request('categoria'),
            'descripcion'      =>  request('descripcion'),
            'stock_actual'     =>  request('stock_actual'),
            'precio'           =>  request('precio'),
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}

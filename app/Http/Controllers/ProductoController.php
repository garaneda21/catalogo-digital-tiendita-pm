<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with('categoria');

        if ($request->has('search')) {
            $query->where('nombre_producto', 'like', '%'.$request->search.'%');
        }

        $productos = $query->paginate(10);

        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();

        return view('admin.productos.create', [
            'categorias' => $categorias,
        ]);
    }

    public function store(Request $request)
    {
        // TODO: Implementar las siguientes validaciones
        // - Producto ya existe

        $request->validate([
            'nombre_producto' => ['required', 'max:250'],
            'categoria' => ['required'],
            'descripcion' => [],
            'stock_actual' => ['gte:0', 'max:9'],
            'precio' => ['required', 'gte:0', 'max:9'],
            'imagen' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // para la imágen
        if ($request->imagen) {
            $url_imagen = '/images/productos/'.time().'.'.$request->imagen->extension();
            $request->imagen->move(public_path('images/productos'), $url_imagen);
        }

        Producto::create([
            'nombre_producto' => request('nombre_producto'),
            'categoria_id' => request('categoria'),
            'descripcion' => request('descripcion'),
            'stock_actual' => request('stock_actual'),
            'precio' => request('precio'),
            'imagen_url' => $url_imagen ?? null,
        ]);

        return redirect('/admin/productos/');
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
        $categorias = Categoria::all();

        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre_producto' => ['required', 'max:250'],
            'categoria' => ['required'],
            'descripcion' => [],
            'stock_actual' => ['nullable', 'gte:0', 'max:9'],
            'precio' => ['required', 'gte:0', 'max:9'],
            'imagen' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // para la imágen
        if ($request->imagen) {
            $url_imagen = '/images/productos/'.time().'.'.$request->imagen->extension();
            $request->imagen->move(public_path('images/productos'), $url_imagen);

            // TODO: eliminar imagen anterior
            /* if ($producto->imagen_url && File::exists($producto->imagen_url)) { */
            /*     File::delete($producto->imagen_url); */
            /* } */
        }

        $producto->update([
            'nombre_producto' => $request->input('nombre_producto'),
            'categoria_id' => $request->input('categoria'),
            'descripcion' => $request->input('descripcion'),
            'stock_actual' => $request->input('stock_actual'),
            'precio' => $request->input('precio'),
            'imagen_url' => $url_imagen ?? $producto->imagen_url,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with('categoria');

        // realiza búsqueda y retorna datos paginados
        $productos = Producto::busqueda($request, $query);

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
            'nombre_producto' => ['required', 'max:250', 'unique:productos'],
            'categoria'       => ['required'],
            'descripcion'     => [],
            'stock_actual'    => ['required', 'gte:0', 'max:9'],
            'precio'          => ['required', 'string', 'max:12'],
            'imagen'          => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        // Limpiamos el string de precio y lo dejamos como entero
        $precioRaw = $request->input('precio'); // "$12.345"
        $precio = (int) str_replace(['$', '.'], '', $precioRaw); // 12345

        // para la imágen
        if ($request->imagen) {
            $url_imagen = '/images/productos/'.time().'.'.$request->imagen->extension();
            $request->imagen->move(public_path('images/productos'), $url_imagen);
        }

        Producto::create([
            'nombre_producto' => request('nombre_producto'),
            'categoria_id'    => request('categoria'),
            'descripcion'     => request('descripcion'),
            'stock_actual'    => request('stock_actual'),
            'precio'          => $precio,
            'imagen_url'      => $url_imagen ?? null,
        ]);

        session()->flash('success_create', '¡Producto creado exitosamente!');

        return redirect('/admin/productos/');
    }

    public function show() {}

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
            'nombre_producto' => ['required', 'max:250', Rule::unique('productos')->ignore($producto->id)],
            'categoria'       => ['required'],
            'descripcion'     => [],
            'stock_actual'    => ['required', 'gte:0', 'max:9'],
            'precio'          => ['required', 'string', 'max:12'],  // el maximo es 12 por los puntos y $
            'imagen'          => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        // Limpiamos el string de precio y lo dejamos como entero
        $precioRaw = $request->input('precio'); // "$12.345"
        $precio = (int) str_replace(['$', '.'], '', $precioRaw); // 12345

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
            'categoria_id'    => $request->input('categoria'),
            'descripcion'     => $request->input('descripcion'),
            'stock_actual'    => $request->input('stock_actual'),
            'precio'          => $precio,
            'imagen_url'      => $url_imagen ?? $producto->imagen_url,
        ]);

        session()->flash('success_update', '¡Producto actualizado exitosamente!');

        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        session()->flash('success_delete', '¡Producto eliminado exitosamente!');

        return redirect()->route('productos.index');
    }
}

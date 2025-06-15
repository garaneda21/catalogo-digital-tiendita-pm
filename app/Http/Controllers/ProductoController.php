<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        if (request()->user('admin')->cannot('viewAny', Producto::class)) {
            return view('admin.productos.index'); // salir sin enviar datos
        }

        $query = Producto::with('categoria');

        // realiza búsqueda y retorna datos paginados
        $productos = Producto::busqueda($request, $query);

        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        if (request()->user('admin')->cannot('create', Producto::class)) { abort(403); }

        $categorias = Categoria::all();

        return view('admin.productos.create', [
            'categorias' => $categorias,
        ]);
    }

    public function store(Request $request)
    {

        if (request()->user('admin')->cannot('create', Producto::class)) { abort(403); }

        $request->validate([
            'nombre_producto' => ['required', 'max:250', 'unique:productos'],
            'categoria'       => ['nullable'],
            'descripcion'     => [],
            'stock_actual'    => ['required', 'string'],
            'precio'          => ['required', 'string'],
            'imagen'          => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        // Limpiamos el string de precio y lo dejamos como entero
        $precioRaw = $request->input('precio'); // "$12.345"
        $precio = (int) str_replace(['$', '.'], '', $precioRaw); // 12345

        // Limpiamos el string de stock_actual y lo dejamos como entero
        $stock = (int) str_replace('.', '', $request->input('stock_actual'));

        // para la imágen
        if ($request->imagen)
            $imagen_url = $request->imagen->store('images/productos');

        $producto = Producto::create([
            'nombre_producto' => request('nombre_producto'),
            'categoria_id'    => request('categoria') ?? null,
            'descripcion'     => request('descripcion'),
            'stock_actual'    => $stock,
            'precio'          => $precio,
            'imagen_url'      => $imagen_url ?? null,
        ]);

        // registrar acción del admin
        Registro::registrar_accion($producto, 'Crea nuevo producto');

        session()->flash('success', '¡Producto creado exitosamente!');

        return redirect('/admin/productos/');
    }

    public function show() {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        if (request()->user('admin')->cannot('update', Producto::class)) { abort(403); }

        $categorias = Categoria::all();

        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        if (request()->user('admin')->cannot('update', Producto::class)) { abort(403); }

        $request->validate([
            'nombre_producto' => ['required', 'max:250', Rule::unique('productos')->ignore($producto->id)],
            'categoria'       => ['nullable'],
            'descripcion'     => [],
            'stock_actual'    => ['required', 'string'],
            'precio'          => ['required', 'string'],
            'imagen'          => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        // Limpiamos el string de precio y lo dejamos como entero
        $precioRaw = $request->input('precio'); // "$12.345"
        $precio = (int) str_replace(['$', '.'], '', $precioRaw); // 12345

        // Limpiamos el string de stock_actual y lo dejamos como entero
        $stock = (int) str_replace('.', '', $request->input('stock_actual'));

        // para la imágen
        if ($request->imagen) {
            $imagen_url = $request->imagen->store('images/productos');

            if ($producto->imagen_url && Storage::exists($producto->imagen_url))
                Storage::delete($producto->imagen_url);
        }

        $producto->update([
            'nombre_producto' => $request->input('nombre_producto'),
            'categoria_id'    => $request->input('categoria') ?? null,
            'descripcion'     => $request->input('descripcion'),
            'stock_actual'    => $stock,
            'precio'          => $precio,
            'imagen_url'      => $imagen_url ?? $producto->imagen_url,
        ]);

        Registro::registrar_accion($producto, 'Edita un producto');

        session()->flash('success', '¡Producto actualizado exitosamente!');

        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        if (request()->user('admin')->cannot('delete', Producto::class)) { abort(403); }

        $producto->delete();

        Registro::registrar_accion($producto, 'Elimina un producto');

        session()->flash('success', '¡Producto eliminado exitosamente!');

        return redirect()->route('productos.index');
    }
}

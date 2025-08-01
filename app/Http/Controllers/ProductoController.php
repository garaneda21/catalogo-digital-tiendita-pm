<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\MotivoMovimiento;
use App\Models\Movimiento;
use App\Models\Producto;
use App\Models\Registro;
use App\Models\TipoMovimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        if (request()->user('admin')->cannot('viewAny', Producto::class)) {
            return view('admin.productos.index'); // salir sin enviar datos
        }

        $query = Producto::query()->with('categoria');

        // Filtro por categoría
        if ($categoria_id = request('categoria')) {
            $query->where('categoria_id', $categoria_id);
        }

        // Filtro por estado de stock
        if ($estado = request('estado_stock')) {
            $query->when($estado === 'agotado', fn ($q) => $q->where('stock_actual', 0))
                ->when($estado === 'bajo', fn ($q) => $q->whereBetween('stock_actual', [1, 5]))
                ->when($estado === 'normal', fn ($q) => $q->where('stock_actual', '>', 5));
        }

        // Filtro por estado activo/inactivo
        if (! is_null(request('activo'))) {
            $query->where('activo', request('activo') === '1');
        }

        // realiza búsqueda y retorna datos paginados
        $productos = Producto::busqueda($request, $query);
        $categorias = Categoria::all();

        return view('admin.productos.index', compact('productos', 'categorias'));
    }

    public function create()
    {
        if (request()->user('admin')->cannot('create', Producto::class)) {
            abort(403);
        }

        $categorias = Categoria::all();

        return view('admin.productos.create', [
            'categorias' => $categorias,
        ]);
    }

    public function store(Request $request)
    {

        if (request()->user('admin')->cannot('create', Producto::class)) {
            abort(403);
        }

        $request->validate([
            'nombre_producto' => ['required', 'max:250', 'unique:productos'],
            'categoria'       => ['nullable'],
            'destacado'       => [],
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
        }

        $producto = Producto::create([
            'nombre_producto' => request('nombre_producto'),
            'slug'            => Str::slug(request('nombre_producto')),
            'categoria_id'    => request('categoria') ?? null,
            'destacado'       => request()->has('destacado'),
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

    public function show(Producto $producto)
    {
        $tipos = TipoMovimiento::all();
        $motivos = MotivoMovimiento::all();

        // Validamos los filtros
        request()->validate([
            'tipo'    => 'nullable|integer|exists:tipo_movimientos,id',
            'motivo'  => 'nullable|integer|exists:motivo_movimientos,id',
            'ordenar' => 'nullable|in:fecha_asc,fecha_desc,cantidad_asc,cantidad_desc',
        ]);

        $movimientos = Movimiento::query()
            ->with('producto')
            ->where('producto_id', $producto->id);

        // Aplicar filtro por tipo
        if ($tipo_id = request('tipo')) {
            $movimientos->where('tipo_movimiento_id', $tipo_id);
        }

        // Aplicar filtro por motivo
        if ($motivo_id = request('motivo')) {
            $movimientos->where('motivo_movimiento_id', $motivo_id);
        }

        // Ordenar por cantidad o fecha
        switch (request('ordenar')) {
            case 'fecha_asc':
                $movimientos->orderBy('created_at', 'asc');
                break;
            case 'fecha_desc':
                $movimientos->orderBy('created_at', 'desc');
                break;
            case 'cantidad_asc':
                $movimientos->orderBy('cantidad', 'asc');
                break;
            case 'cantidad_desc':
                $movimientos->orderBy('cantidad', 'desc');
                break;
            default:
                $movimientos->orderBy('created_at', 'desc');
                break;
        }

        $movimientos = $movimientos->paginate(20);

        return view('admin.productos.show', compact(
            'producto',
            'movimientos',
            'tipos',
            'motivos',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        if (request()->user('admin')->cannot('update', Producto::class)) {
            abort(403);
        }

        $categorias = Categoria::all();

        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        if (request()->user('admin')->cannot('update', Producto::class)) {
            abort(403);
        }

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

            if ($producto->imagen_url && Storage::exists($producto->imagen_url)) {
                Storage::delete($producto->imagen_url);
            }
        }

        $producto->update([
            'nombre_producto' => $request->input('nombre_producto'),
            'slug'            => Str::slug($request->input('nombre_producto')),
            'categoria_id'    => $request->input('categoria') ?? null,
            'destacado'       => $request->has('destacado'),
            'descripcion'     => $request->input('descripcion'),
            'stock_actual'    => $stock,
            'precio'          => $precio,
            'imagen_url'      => $imagen_url ?? $producto->imagen_url,
        ]);

        Registro::registrar_accion($producto, 'Edita un producto');

        session()->flash('success', '¡Producto actualizado exitosamente!');

        return redirect()->route('productos.show', $producto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        if (request()->user('admin')->cannot('delete', Producto::class)) {
            abort(403);
        }

        $producto->delete();

        Registro::registrar_accion($producto, 'Elimina un producto');

        session()->flash('success', '¡Producto eliminado exitosamente!');

        return redirect()->route('productos.index');
    }

    public function disable(Producto $producto)
    {
        if (request()->user('admin')->cannot('update', Producto::class)) {
            abort(403);
        }

        if ($producto->activo) {
            $producto->update(['activo' => false]);
            session()->flash('success', 'Producto desactivado');
            Registro::registrar_accion($producto, 'Desactiva un producto');
        } else {
            $producto->update(['activo' => true]);
            session()->flash('success', 'Producto reactivado');
            Registro::registrar_accion($producto, 'Reactiva un producto');
        }

        return redirect()->back();
    }
}

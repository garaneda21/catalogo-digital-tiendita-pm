<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\MotivoMovimiento;
use App\Models\Movimiento;
use App\Models\Producto;
use App\Models\Registro;
use App\Models\TipoMovimiento;
use Illuminate\Http\Request;

class MovimientosController extends Controller
{
    public function index(Request $request)
    {
        $query = Movimiento::query()
            ->with(['producto.categoria', 'tipo_movimiento', 'motivo_movimiento']);

        // Búsqueda por nombre del producto
        if ($search = $request->input('search')) {
            $query->whereHas('producto', fn ($q) => $q->where('nombre_producto', 'like', '%'.$search.'%'));
        }

        // Filtro por categoría
        if ($categoria = $request->input('categoria')) {
            $query->whereHas('producto', fn ($q) => $q->where('categoria_id', $categoria));
        }

        // Filtro por tipo de movimiento
        if ($tipo = $request->input('tipo')) {
            $query->where('tipo_movimiento_id', $tipo);
        }

        // Filtro por motivo de movimiento
        if ($motivo = $request->input('motivo')) {
            $query->where('motivo_movimiento_id', $motivo);
        }

        // Filtro por fecha
        if ($desde = $request->input('desde')) {
            $query->whereDate('movimientos.created_at', '>=', $desde);
        }

        if ($hasta = $request->input('hasta')) {
            $query->whereDate('movimientos.created_at', '<=', $hasta);
        }

        // Ordenamiento
        switch ($request->input('ordering')) {
            case 'nombre_asc':
                $query->orderByProductoNombre('asc');
                break;
            case 'nombre_desc':
                $query->orderByProductoNombre('desc');
                break;
            case 'precio_total_asc':
                Movimiento::obtener_precio_total($query)
                    ->orderBy('precio_total', 'asc');
                break;
            case 'precio_total_desc':
                Movimiento::obtener_precio_total($query)
                    ->orderBy('precio_total', 'desc');
                break;
            case 'cantidad_asc':
                $query->orderBy('cantidad', 'asc');
                break;
            case 'cantidad_desc':
                $query->orderBy('cantidad', 'desc');
                break;
            case 'fecha_asc':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->latest(); // fecha descendente por defecto
        }

        $movimientos = $query->paginate(20);
        $categorias = Categoria::all();
        $tipos = TipoMovimiento::all();
        $motivos = MotivoMovimiento::all();

        return view('admin.movimientos.index', compact(
            'movimientos',
            'categorias',
            'tipos',
            'motivos'
        ));
    }

    public function create_venta(Producto $producto)
    {
        $motivos = MotivoMovimiento::all()->where('tipo_movimiento_id', 1);

        return view('admin.movimientos.create-venta', compact('producto', 'motivos'));
    }

    public function store_venta(Request $request, Producto $producto)
    {
        // TODO: Cantidad debe ser >= a la cantidad actual en la bd

        $data = $request->validate([
            'cantidad' => ['required', 'string', 'gt:0'],
            'motivo'   => ['required'],
        ]);

        $cantidad = (int) str_replace('.', '', $request->input('cantidad'));

        if ($cantidad > $producto->stock_actual) {
            return back()->withErrors(['cantidad' => 'La cantidad supera el stock disponible ('.$producto->stock_actual.')'])->withInput();
        }

        Movimiento::create([
            'cantidad'             => $cantidad,
            'producto_id'          => $producto->id,
            'tipo_movimiento_id'   => 1, // 1 -> salida
            'motivo_movimiento_id' => $request->input('motivo'),
        ]);

        $producto->update(['stock_actual' => $producto->stock_actual - $cantidad]);

        Registro::registrar_accion($producto, 'Vende un producto');

        return redirect('/admin/productos/');
    }

    public function create_stock(Producto $producto)
    {
        $motivos = MotivoMovimiento::all()->where('tipo_movimiento_id', 2);

        return view('admin.movimientos.create-stock', compact('producto', 'motivos'));
    }

    public function store_stock(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'cantidad' => ['required', 'integer', 'gt:0'],
            'motivo'   => ['required'],
        ]);

        $cantidad = (int) str_replace('.', '', $request->input('cantidad'));

        if ($cantidad <= 0) {
            return back()->withErrors(['cantidad' => 'La cantidad debe ser mayor a cero'])->withInput();
        }

        Movimiento::create([
            'cantidad'             => $cantidad,
            'producto_id'          => $producto->id,
            'tipo_movimiento_id'   => 2,                  // 2 -> entrada
            'motivo_movimiento_id' => $data['motivo'],
        ]);

        $producto->increment('stock_actual', $data['cantidad']);

        return redirect('/admin/productos/')->with('success', 'Movimiento registrado correctamente.');
    }
}

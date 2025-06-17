<?php

namespace App\Http\Controllers;

use App\Models\MotivoMovimiento;
use App\Models\Movimiento;
use App\Models\Producto;
use Illuminate\Http\Request;

class MovimientosController extends Controller
{
    public function index()
    {
        // retornar datos de ventas y entradas
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
            'cantidad' => $cantidad,
            'producto_id' => $producto->id,
            'tipo_movimiento_id' => 1, // 1 -> salida
            'motivo_movimiento_id'   => $request->input('motivo'),
        ]);

        $producto->update(['stock_actual' => $producto->stock_actual - $cantidad]);

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
            'cantidad' => $cantidad,
            'producto_id' => $producto->id,
            'tipo_movimiento_id' => 2,                  // 2 -> entrada
            'motivo_movimiento_id'   => $data['motivo'],
        ]);

        $producto->increment('stock_actual', $data['cantidad']);

        return redirect('/admin/productos/')->with('success', 'Movimiento registrado correctamente.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $movimientos = Movimiento::query()
            ->with(['producto', 'tipo_movimiento', 'motivo_movimiento'])
            ->latest()
            ->take(10)
            ->get();

        $ventas_mes = Movimiento::query()
            ->where('tipo_movimiento_id', 1)
            ->whereMonth('created_at', now()->month)
            ->sum('cantidad');

        $entradas_mes = Movimiento::query()
            ->where('tipo_movimiento_id', 2)
            ->whereMonth('created_at', now()->month)
            ->sum('cantidad');

        $bajo_stock = Producto::query()
            ->where('stock_actual', '<', 5)
            ->count();

        $stock_total = Producto::all()->sum('stock_actual');

        $valor_total_productos = DB::table('productos')
            ->select(DB::raw('SUM(precio * stock_actual) as total'))
            ->value('total');

        $top_productos = Movimiento::select('producto_id', DB::raw('SUM(cantidad) as total'))
            ->where('tipo_movimiento_id', 1)
            ->groupBy('producto_id')
            ->orderByDesc('total')
            ->take(5)
            ->with('producto') // para obtener nombre
            ->get();

        return view('admin.dashboard', compact(
            'movimientos',
            'ventas_mes',
            'entradas_mes',
            'bajo_stock',
            'stock_total',
            'valor_total_productos',
            'top_productos'
        ));
    }
}

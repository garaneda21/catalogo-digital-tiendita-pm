<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\ItemCarrito;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    /**
     * Muestra la vista del carrito
     */
    public function index()
    {
        $carrito = $this->obtenerOCrearCarrito();
        $total = $carrito->items->sum(fn($item) => $item->precio_unitario * $item->cantidad);

        $descuentoTotal = $carrito->items->sum(function ($item) {
            return $item->producto->precio_normal
                ? ($item->producto->precio_normal - $item->precio_unitario) * $item->cantidad
                : 0;
        });

        $totalConCencoPay = $total - $descuentoTotal;
        $totalConCencosud = $totalConCencoPay - 50000; // ejemplo de descuento
        $totalConOtros = $totalConCencoPay;

        return view('carrito.index', compact(
            'carrito',
            'total',
            'descuentoTotal',
        ));
    }


    /**
     * Agrega un producto al carrito
     */
    public function agregar(Request $request, $productoId)
    {
        $producto = Producto::findOrFail($productoId);
        $carrito = $this->obtenerOCrearCarrito();
            // Buscar si ya existe el producto en el carrito
        $item = $carrito->items()->where('producto_id', $productoId)->first();

        if ($item) {
            // Verificar si al aumentar en 1 se supera el stock
            if ($item->cantidad + 1 > $producto->stock_actual) {
                return redirect()->back()->with('error', 'No hay suficiente stock disponible para este producto.');
            }

            $item->increment('cantidad');
        } else {
            // Verificar si hay al menos 1 en stock antes de crear
            if ($producto->stock_actual < 1) {
                return redirect()->back()->with('error', 'Este producto no tiene stock disponible.');
            }
        
            $item = $carrito->items()->firstOrCreate(
                ['producto_id' => $productoId],
                [
                    'precio_unitario' => $producto->precio,
                    'cantidad' => 1
                ]
            );
        }    
        if (!$item->wasRecentlyCreated) {
            $item->increment('cantidad');
        }

        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    /**
     * Actualiza la cantidad de un ítem del carrito
     */
    public function actualizar(Request $request, $itemId)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ]);

        $item = ItemCarrito::findOrFail($itemId);
        $item->update(['cantidad' => $request->cantidad]);

        return redirect()->back()->with('success', 'Cantidad actualizada correctamente');
    }

    /**
     * Elimina un ítem del carrito
     */
    public function eliminar($itemId)
    {
        $item = ItemCarrito::findOrFail($itemId);
        $item->delete();

        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }

    /**
     * Obtiene o crea el carrito actual (autenticado o invitado)
     */
    private function obtenerOCrearCarrito()
    {
        if (Auth::guard('web')->check()) {
            return Carrito::firstOrCreate(
                ['user_id' => Auth::guard('web')->id()],
                ['token' => session()->getId()]
            );
        }

        return Carrito::firstOrCreate(
            ['token' => session()->getId()]
        );
    }

    public function apiAgregar(Request $request, Producto $producto)
    {
        $carrito = $this->obtenerOCrearCarrito();

        // Cantidad que el usuario quiere agregar (por defecto 1)
        $cantidadSolicitada = $request->input('cantidad', 1);

        // Verificamos si ya hay un item de este producto en el carrito
        $itemExistente = $carrito->items()->where('producto_id', $producto->id)->first();
        $cantidadActual = $itemExistente?->cantidad ?? 0;

        $cantidadTotal = $cantidadActual + $cantidadSolicitada;

        // Validación: no permitir más que el stock disponible
        if ($cantidadTotal > $producto->stock_actual) {
            return response()->json([
                'error' => true,
                'message' => 'No hay suficiente stock disponible para este producto.',
                'stock_disponible' => $producto->stock_actual,
            ], 422);
        }

        // Creamos o actualizamos el item
        $item = $carrito->items()->firstOrCreate(
            ['producto_id' => $producto->id],
            [
                'precio_unitario' => $producto->precio,
                'cantidad' => 0
            ]
        );

        $item->increment('cantidad', $cantidadSolicitada);
        $item->load('producto');

        return response()->json([
            'error' => false,
            'carrito' => $carrito->load('items.producto')
        ]);
    }

    public function apiActualizarCantidad(Request $request, ItemCarrito $item)
    {
        $delta = (int) $request->input('delta', 1);
        $nuevoValor = $item->cantidad + $delta;
    
        $stockDisponible = $item->producto->stock_actual;
    
        if ($nuevoValor > $stockDisponible) {
            return response()->json([
                'error' => 'No hay suficiente stock disponible.',
                'stock_disponible' => $stockDisponible
            ], 422);
        }
    
        // Si al decrementar la cantidad queda 0 o menos, se elimina el ítem
        if ($nuevoValor < 1) {
            $item->delete();
        } else {
            $item->cantidad = $nuevoValor;
            $item->save();
        }
    
        return response()->json(['carrito' => $item->carrito->load('items.producto')]);
    }

    public function apiEliminar(ItemCarrito $item)
    {
        $item->delete();
        return response()->json(['carrito' => $item->carrito->load('items.producto')]);
    }

}

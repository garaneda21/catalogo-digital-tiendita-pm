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

        $item = $carrito->items()->firstOrCreate(
            ['producto_id' => $productoId],
            [
                'precio_unitario' => $producto->precio,
                'cantidad' => 1
            ]
        );

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
        $item = $carrito->items()->firstOrCreate(
            ['producto_id' => $producto->id],
            ['precio_unitario' => $producto->precio, 'cantidad' => 0]
        );
        $item->increment('cantidad', $request->input('cantidad', 1));
        $item->load('producto');

        return response()->json(['carrito' => $carrito->load('items.producto')]);
    }

    public function apiActualizarCantidad(Request $request, ItemCarrito $item)
    {
        $delta = $request->input('delta', 1);
        $item->increment('cantidad', $delta);
        if ($item->cantidad < 1) $item->delete();
        return response()->json(['carrito' => $item->carrito->load('items.producto')]);
    }

    public function apiEliminar(ItemCarrito $item)
    {
        $item->delete();
        return response()->json(['carrito' => $item->carrito->load('items.producto')]);
    }

}

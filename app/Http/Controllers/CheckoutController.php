<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\ItemCarrito;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Muestra la vista de checkout
     */
    public function index()
    {
        $carrito = Carrito::with('items.producto')
            ->where(function ($query) {
                $query->when(Auth::check(), fn($q) => $q->where('user_id', Auth::id()))
                      ->when(!Auth::check(), fn($q) => $q->where('token', session()->getId()));
            })
            ->first();

        if (!$carrito || $carrito->items->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }

        $totalSinDescuento = $carrito->items->sum(function ($item) {
            return $item->producto->precio * $item->cantidad;
        });
        $totalConDescuento = $carrito->items->sum(function ($item) {
            $producto = $item->producto;
            $descuento = $producto->descuento ? ($producto->precio * $producto->descuento / 100) : 0;
            return ($producto->precio - $descuento) * $item->cantidad;
        });
        $descuentoTotal = $totalSinDescuento - $totalConDescuento;

        return view('checkout.index', [
            'carrito' => $carrito,
            'totalSinDescuento' => $totalSinDescuento,
            'totalConDescuento' => $totalConDescuento,
            'descuentoTotal' => $descuentoTotal,
        ]);
    }

    /**
     * Obtiene o crea un carrito para el usuario autenticado
     
    *private function obtenerOCrearCarrito()
    *{
     *   $usuarioId = Auth::id();
      *  return Carrito::firstOrCreate(['usuario_id' => $usuarioId]);
    *}
    */
}
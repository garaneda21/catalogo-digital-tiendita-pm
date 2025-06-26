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
        //$carrito = $this->obtenerOCrearCarrito();
        return view('checkout.index');
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
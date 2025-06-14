<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\ItemCarrito;
use App\Models\Producto;
use Illuminate\Routing\Controller; // Ensure you import the correct Controller class
use Illuminate\Support\Facades\Auth; // Import Auth facade if needed
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = $this->obtenerOCrearCarrito();
        return view('carrito.index', compact('carrito'));
    }

    public function agregar(Request $request, $productoId)
    {
        $producto = Producto::findOrFail($productoId);
        $carrito = $this->obtenerOCrearCarrito();

        $item = $carrito->items()->firstOrCreate(
            ['producto_id' => $productoId],
            ['precio_unitario' => $producto->precio, 'cantidad' => 1]
        );

        if (!$item->wasRecentlyCreated) {
            $item->increment('cantidad');
        }

        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    public function actualizar(Request $request, $itemId)
    {
        $item = ItemCarrito::findOrFail($itemId);
        $item->update(['cantidad' => $request->input('cantidad')]);
        return redirect()->back()->with('success', 'Cantidad actualizada');
    }

    public function eliminar($itemId)
    {
        $item = ItemCarrito::findOrFail($itemId);
        $item->delete();
        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }

    private function obtenerOCrearCarrito()
    {
        if (auth()->check()) {
            return Carrito::firstOrCreate(
                ['user_id' => auth()->id()],
                ['token' => session()->getId()]
            );
        }

        return Carrito::firstOrCreate(['token' => session()->getId()]);
    }
}

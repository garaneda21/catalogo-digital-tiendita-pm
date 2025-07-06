<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\ItemCarrito;
use App\Models\Producto; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    /**
     * Muestra el contenido del carrito de compras.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $carrito = $this->getCart();
        
        // Eager load para evitar problemas N+1
        $carrito->load('items.producto');

        // Calcular el total
        $total = $carrito->items->reduce(function ($carry, $item) {
            return $carry + ($item->cantidad * $item->precio_unitario);
        }, 0);

        return view('carrito.index', compact('carrito', 'total'));
    }

    /**
     * Agrega un producto al carrito.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    
    public function add(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $carrito = $this->getCart();
        $producto = Producto::find($request->producto_id);

        // --- INICIO DE LA MODIFICACIÓN ---

        // 1. Obtenemos la cantidad que ya está en el carrito para este producto
        $itemExistente = $carrito->items()->where('producto_id', $producto->id)->first();
        $cantidadEnCarrito = $itemExistente ? $itemExistente->cantidad : 0;

        // 2. Calculamos la cantidad total que el usuario desea tener
        $cantidadDeseada = $cantidadEnCarrito + $request->cantidad;

        // 3. Comparamos con el stock disponible
        if ($producto->stock_actual < $cantidadDeseada) {
            // Si la cantidad deseada supera el stock, regresamos con un error
            return redirect()->back()->with('error', 'No hay suficiente stock. Solo quedan ' . $producto->stock_actual . ' unidades.');
        }

        // --- FIN DE LA MODIFICACIÓN ---

        // Si hay stock, procedemos como antes.
        // Usamos updateOrCreate para simplificar la lógica de creación/actualización.
        ItemCarrito::updateOrCreate(
            [
                'carrito_id' => $carrito->id,
                'producto_id' => $producto->id,
            ],
            [
                // Usamos DB::raw para incrementar la cantidad de forma segura
                'cantidad' => DB::raw("cantidad + {$request->cantidad}"), 
                'precio_unitario' => $producto->precio,
            ]
        );

        return redirect()->back()->with('success', 'Producto agregado al carrito!');
    }

    /**
     * Actualiza la cantidad de un item en el carrito.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $itemId
     * @return \Illuminate\Http\RedirectResponse
     */
    
    public function update(Request $request, $itemId)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $carrito = $this->getCart();
        // Eager load el producto para tener acceso al stock
        $item = ItemCarrito::with('producto') 
                           ->where('id', $itemId)
                           ->where('carrito_id', $carrito->id)
                           ->firstOrFail();

        // --- INICIO DE LA MODIFICACIÓN ---

        // Comparamos la nueva cantidad solicitada con el stock del producto
        if ($item->producto->stock_actual < $request->cantidad) {
            return redirect()->route('carrito.index')->with('error', 'No puedes agregar más de ' . $item->producto->stock_actual . ' unidades.');
        }

        // --- FIN DE LA MODIFICACIÓN ---

        $item->update(['cantidad' => $request->cantidad]);

        return redirect()->route('carrito.index')->with('success', 'Carrito actualizado.');
    }

    /**
     * Elimina un item del carrito.
     *
     * @param  int  $itemId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($itemId)
    {
        $carrito = $this->getCart();
        $item = ItemCarrito::where('id', $itemId)
                           ->where('carrito_id', $carrito->id) // Verificación de seguridad
                           ->firstOrFail();

        $item->delete();

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }

    /**
     * Vacía todo el carrito de compras.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear()
    {
        $carrito = $this->getCart();
        $carrito->items()->delete();

        return redirect()->route('carrito.index')->with('success', 'El carrito ha sido vaciado.');
    }

    /**
     * Obtiene el carrito actual del usuario (autenticado o invitado) o crea uno nuevo.
     *
     * @return \App\Models\Carrito
     */
    private function getCart()
    {
        $user = Auth::user();
        $cart = null;

        if ($user) {
            // Usuario autenticado: busca su carrito o crea uno nuevo.
            $cart = Carrito::firstOrCreate(
                ['user_id' => $user->id],
                ['token' => Str::random(40)] // Genera un token por si acaso
            );
        } else {
            // Usuario invitado: busca el carrito por el token en la sesión.
            $token = session('cart_token');
            if ($token) {
                $cart = Carrito::where('token', $token)->first();
            }

            // Si no hay carrito para el invitado, crea uno nuevo.
            if (!$cart) {
                $cart = Carrito::create([
                    'token' => Str::random(40),
                ]);
                session(['cart_token' => $cart->token]);
            }
        }
        
        return $cart;
    }
}

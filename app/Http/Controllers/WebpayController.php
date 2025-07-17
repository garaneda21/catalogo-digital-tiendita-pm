<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\ItemOrden;
use App\Models\Movimiento;
use App\Models\Orden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus\Transaction;

class WebpayController extends Controller
{
    private function crearTransaccion(): Transaction
    {
        $commerceCode = config('transbank.webpay_plus.commerce_code');
        $apiKey = config('transbank.webpay_plus.api_key');
        $integrationType = config('transbank.webpay_plus.integration_type');

        $environment = $integrationType === 'LIVE'
            ? Options::ENVIRONMENT_PRODUCTION
            : Options::ENVIRONMENT_INTEGRATION;

        $options = new Options($apiKey, $commerceCode, $integrationType);

        return new Transaction($options);
    }

    public function iniciarPago(Request $request)
    {
        $carrito = Carrito::with('items.producto')
            ->where(function ($query) {
                $query->when(Auth::check(), fn ($q) => $q->where('user_id', Auth::id()))
                    ->when(! Auth::check(), fn ($q) => $q->where('token', session()->getId()));
            })
            ->firstOrFail();

        $amount = $carrito->items->sum(fn ($item) => $item->precio_unitario * $item->cantidad);
        $buyOrder = uniqid('N'); // Orden única (requerida)
        $sessionId = session()->getId();
        $returnUrl = route('webpay.respuesta');

        $transaction = $this->crearTransaccion();
        $response = $transaction->create($buyOrder, $sessionId, $amount, $returnUrl);

        // Redirige al formulario de Transbank
        return view('checkout.redirect', [
            'url'   => $response->getUrl(),
            'token' => $response->getToken(),
        ]);
    }

    public function respuestaPago(Request $request)
    {
        $token = $request->input('token_ws');
        if (! $token) {
            return redirect()->route('checkout.error');
        }

        $transaction = $this->crearTransaccion();
        $response = $transaction->commit($token);

        // Aquí podrías verificar el estado y guardar en la DB
        if ($response->isApproved()) {
            // Verificar si el carrito existe
            $carrito = Carrito::with('items.producto')
                ->where(function ($query) {
                    $query->when(Auth::check(), fn ($q) => $q->where('user_id', Auth::id()))
                        ->when(! Auth::check(), fn ($q) => $q->where('token', session()->getId()));
                })
                ->first();

            if (! $carrito) {
                return redirect()->route('checkout.error');
            }

            // Crear la orden en la base de datos
            $orden = Orden::create([
                'user_id'      => Auth::id(),
                'token_sesion' => session()->getId(),
                'buy_order'    => $response->getBuyOrder(),
                'monto_total'  => $response->getAmount(),
                'estado'       => 'aprobado',
            ]);

            if (Auth::check()) {
                Auth::user()->notify(new \App\Notifications\PagoAprobado($orden));
            }

            // Guardar los items del carrito en la orden
            foreach ($carrito->items as $item) {
                ItemOrden::create([
                    'orden_id'        => $orden->id,
                    'producto_id'     => $item->producto_id,
                    'cantidad'        => $item->cantidad,
                    'precio_unitario' => $item->precio_unitario,
                ]);

                $producto = $item->producto;
                $producto->stock_actual -= $item->cantidad;
                $producto->save();

                // --- registrar venta
                Movimiento::create([
                    'cantidad'             => $item->cantidad,
                    'producto_id'          => $item->id,
                    'tipo_movimiento_id'   => 1, // 1 -> salida
                    'motivo_movimiento_id' => 5,
                ]);

                $producto->update(['stock_actual' => $producto->stock_actual - $item->cantidad]);
                // --- registrar venta
            }

            // Limpiar el carrito después de la compra
            $carrito->items()->delete();
            $carrito->delete();

            return view('checkout.exito', ['response' => $response]);
        } else {
            return view('checkout.error', ['response' => $response]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\ItemCarrito;
use Illuminate\Support\Facades\Auth;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\WebpayPlus\Responses\TransactionCommitResponse;

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
                $query->when(Auth::check(), fn($q) => $q->where('user_id', Auth::id()))
                      ->when(!Auth::check(), fn($q) => $q->where('token', session()->getId()));
            })
            ->firstOrFail();


        $amount = $carrito->items->sum(fn($item) => $item->precio_unitario * $item->cantidad);
        $buyOrder = uniqid('N'); // Orden única (requerida)
        $sessionId = session()->getId();
        $returnUrl = route('webpay.respuesta');
        
        $transaction = $this->crearTransaccion();
        $response = $transaction->create($buyOrder, $sessionId, $amount, $returnUrl);

        // Redirige al formulario de Transbank
        return view('checkout.redirect', [
            'url' => $response->getUrl(), 
            'token' => $response->getToken()
        ]);
    }

    public function respuestaPago(Request $request)
    {
        $token = $request->input('token_ws');
        if (!$token) {
            return redirect()->route('checkout.error');
        }

        $transaction = $this->crearTransaccion();
        $response = $transaction->commit($token);
        
        // Aquí podrías verificar el estado y guardar en la DB
        if ($response->isApproved()) {
            // Guardar datos en base de datos

            return view('checkout.exito', ['response' => $response]);
        } else {
            return view('checkout.error', ['response' => $response]);
        }
    }
}

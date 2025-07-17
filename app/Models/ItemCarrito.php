<?php

namespace App\Models;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;

class ItemCarrito extends Model
{
    protected $fillable = ['carrito_id', 'producto_id', 'cantidad', 'precio_unitario'];

    protected $table = 'items_carrito';

    public function carrito()
    {
        return $this->belongsTo(Carrito::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}

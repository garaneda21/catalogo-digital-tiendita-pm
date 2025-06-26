<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemOrden extends Model
{
    use HasFactory;

    protected $table = 'items_orden';

    protected $fillable = [
        'orden_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
    ];

    public function orden()
    {
        return $this->belongsTo(Orden::class, 'orden_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}

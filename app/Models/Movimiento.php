<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $fillable = [
        'cantidad',
        'producto_id',
        'tipo_movimiento_id',
        'motivo_movimiento_id',
    ];

    public function producto() {
        return $this->belongsTo(Producto::class);
    }

    public function tipo_movimiento() {
        return $this->belongsTo(TipoMovimiento::class);
    }

    public function motivo_movimiento() {
        return $this->belongsTo(MotivoMovimiento::class);
    }
}

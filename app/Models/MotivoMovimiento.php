<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotivoMovimiento extends Model
{
    protected $fillable = ['nombre_motivo', 'tipo_movimiento_id'];

    public $timestamps = false;

    public function movimientos() {
        return $this->hasMany(Movimiento::class);
    }

    public function tipo_movimiento() {
        return $this->belongsTo(TipoMovimiento::class, 'tipo_motivo_id');
    }
}

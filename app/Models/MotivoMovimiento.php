<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotivoMovimiento extends Model
{
    protected $fillable = ['nombre_motivo', 'tipo_motivo_id'];

    public $timestamps = false;

    public function movimiento() {
        return $this->hasOne(Movimiento::class);
    }

    public function tipo_movimiento() {
        return $this->hasOne(TipoMovimiento::class);
    }
}

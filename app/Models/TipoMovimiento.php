<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMovimiento extends Model
{
    protected $fillable = ['nombre_tipo'];

    public $timestamps = false;

    public function movimientos() {
        return $this->hasMany(Movimiento::class);
    }
}

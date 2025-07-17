<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMovimiento extends Model
{
    protected $fillable = ['nombre_tipo'];

    public $timestamps = false;

    public function movimiento() {
        return $this->hasOne(Movimiento::class);
    }
}

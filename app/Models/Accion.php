<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    /** @use HasFactory<\Database\Factories\AccionFactory> */
    use HasFactory;

    protected $table = 'acciones';

    public $timestamps = false;

    protected $fillable = ['nombre_accion'];

    public function registros() {
        return $this->belongsTo(Registro::class);
    }

}

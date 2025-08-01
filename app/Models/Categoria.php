<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriaFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre_categoria',
        'slug',
        'descripcion_categoria'
    ];

    public $timestamps = false;

    public function productos() {
        return $this->hasMany(Producto::class);
    }



}

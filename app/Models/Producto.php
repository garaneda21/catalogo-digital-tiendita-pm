<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre_producto',
        'drescripcion',
        'stock_actual',
        'precio',
        'imagen_url',
    ];

    public $timestamps = false;
}

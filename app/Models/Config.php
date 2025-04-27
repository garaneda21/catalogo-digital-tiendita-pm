<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    /** @use HasFactory<\Database\Factories\ConfigFactory> */
    use HasFactory;

    protected $fillable = [
        'numero_whatsapp',
        'nombre_tienda',
        'seo_keywords',
        'seo_descriptions',
    ];
}

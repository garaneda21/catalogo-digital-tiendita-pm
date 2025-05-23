<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    /** @use HasFactory<\Database\Factories\AdministradorFactory> */
    use HasFactory;

    protected $table = 'administradores';

    protected $fillable = [
        'nombre_admin',
        'correo_admin',
        'password', // evaluar si es seguro
        'activo',
    ];
}

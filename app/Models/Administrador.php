<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\AdministradorFactory> */
    use HasFactory, Notifiable;

    protected $table = 'administradores';

    protected $fillable = [
        'nombre_admin',
        'correo_admin',
        'password', 
        'activo',
    ];

    protected $hidden = [
        'password',
    ];
}

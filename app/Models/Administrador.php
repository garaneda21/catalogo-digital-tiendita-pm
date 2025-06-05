<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    use Notifiable;

    protected $table = 'administradores';

    protected $fillable = [
        'nombre_admin',
        'correo_admin',
        'pwd',
        'activo',
    ];

    // Laravel necesita saber qué campo usar como contraseña
    public function getAuthPassword()
    {
        return $this->pwd;
    }

    // Laravel necesita saber el campo que usas como correo/username
    public function getAuthIdentifierName()
    {
        return 'correo_admin';
    }
}

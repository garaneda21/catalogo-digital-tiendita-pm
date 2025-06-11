<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermisosAdmin extends Model
{
    protected $fillable = [
        'administrador_id',
        'permisos_id',
    ];

    public $timestamps = false;
}

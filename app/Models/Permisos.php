<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    public $timestamps = false;

    protected $fillable = ['nombre_permiso'];

    public function admin()
    {
        return $this->belongsToMany(Administrador::class, 'permisos_admins') ? true : false;
    }

    /* public function permisos_admins() { */
    /*     return $this->belongsTo(PermisosAdmin::class); */
    /* } */
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    public $timestamps = false;

    protected $fillable = ['nombre_permiso'];

    /* public function permisos_admins() { */
    /*     return $this->belongsTo(PermisosAdmin::class); */
    /* } */
}

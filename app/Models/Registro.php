<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Registro extends Model
{
    /** @use HasFactory<\Database\Factories\RegistroFactory> */
    use HasFactory;

    protected $fillable = [
        'id_entidad_modificada',
        'entidad_modificada',
        'fecha_registro',
        'accion_id',
        'administrador_id',
    ];

    public $timestamps = false;

    /**
    * Registra la acción realizada por el usuario en la base de datos.
    * - modelo: datos entrantes de la tabla que se está modificando
    * - nombre_modelo: nombre de la tabla (string)
    * - id_acción: revisar tabla de acciones para ver disponibles (id int)
    */
    public static function registrar_accion($modelo, string $nombre_modelo, int $id_accion)
    {
        $admin = Auth::guard('admin')->user();

        // registrar acción del admin
        Registro::create([
            'id_entidad_modificada' => $modelo->id,
            'entidad_modificada'    => $nombre_modelo,
            'fecha_registro'        => now(),
            'accion_id'             => $id_accion,
            'administrador_id'      => $admin->id,
        ]);
    }
}

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

    public function accion()
    {
        return $this->belongsTo(Accion::class);
    }

    /**
     * Registra la acción realizada por el usuario en la base de datos.
     * - modelo: datos entrantes de la tabla que se está modificando
     * - nombre_modelo: nombre de la tabla (string)
     * - id_acción: revisar tabla de acciones para ver disponibles (id int)
     */
    public static function registrar_accion($modelo, string|null $nombre_modelo, int $id_accion)
    {
        $admin = Auth::guard('admin')->user();

        // registrar acción del admin
        Registro::create([
            'id_entidad_modificada' => $modelo->id ?? null,
            'entidad_modificada'    => $nombre_modelo,
            'fecha_registro'        => now(),
            'accion_id'             => $id_accion,
            'administrador_id'      => $admin->id,
        ]);
    }

    public static function obtener_modelo_registro(int|null $id_modelo, string|null $nombre_modelo)
    {
        $mapa_modelos = [
            'productos' => Producto::class,
            'admins'    => Administrador::class,
            // agrega más entidades aquí si las necesitas
        ];

        if (array_key_exists($nombre_modelo, $mapa_modelos)) {
            $modelo = $mapa_modelos[$nombre_modelo];
            $dato_modificado = $modelo::find($id_modelo);

            if (!$dato_modificado) {
                return response()->json(['error' => 'Registro no encontrado'], 404);
            }

            return $dato_modificado;
        } else {
            return response()->json(['error' => 'Entidad desconocida'], 400);
        }
    }
}

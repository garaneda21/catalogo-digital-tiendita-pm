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

    public function admin()
    {
        return $this->belongsTo(Administrador::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Registra la acción realizada por el usuario en la base de datos.
     * - modelo: datos entrantes de la tabla que se está modificando
     * - nombre_acción: nombre de la acción a realizar, si no existe, se crea una nueva acción
     */
    public static function registrar_accion(Model|null $modelo, string $nombre_accion)
    {
        $admin = Auth::guard('admin')->user();
        $user = Auth::guard('web')->user();

        // Buscar o crear la acción
        $accion = Accion::firstOrCreate(['nombre_accion' => $nombre_accion]);

        // registrar acción del admin
        Registro::create([
            'id_entidad_modificada' => $modelo->id ?? null,
            'entidad_modificada'    => $modelo?->getTable(),
            'fecha_registro'        => now(),
            'accion_id'             => $accion->id,
            'administrador_id'      => $admin?->id,
            'user_id'               => $user?->id,
        ]);
    }

    public static function obtener_modelo_registro(?int $id_modelo, ?string $nombre_modelo)
    {
        $mapa_modelos = [
            'productos'  => Producto::class,
            'admins'     => Administrador::class,
            'users'      => User::class,
            'categorias' => Categoria::class,
            // agrega más entidades aquí si las necesitas
        ];

        if (array_key_exists($nombre_modelo, $mapa_modelos)) {
            $modelo = $mapa_modelos[$nombre_modelo];
            $dato_modificado = $modelo::find($id_modelo);

            if (! $dato_modificado) {
                return response()->json(['error' => 'Registro no encontrado'], 404);
            }

            return $dato_modificado;
        } else {
            return response()->json(['error' => 'Entidad desconocida'], 400);
        }
    }
}

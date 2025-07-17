<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movimiento extends Model
{
    protected $fillable = [
        'cantidad',
        'producto_id',
        'tipo_movimiento_id',
        'motivo_movimiento_id',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function tipo_movimiento()
    {
        return $this->belongsTo(TipoMovimiento::class);
    }

    public function motivo_movimiento()
    {
        return $this->belongsTo(MotivoMovimiento::class);
    }

    public function scopeOrderByProductoNombre($query, $direction = 'asc')
    {
        return $query->join('productos', 'movimientos.producto_id', '=', 'productos.id')
            ->orderBy('productos.nombre_producto', $direction)
            ->select('movimientos.*');
    }

    public function scopeOrderByProductoPrecio($query, $direction = 'asc')
    {
        return $query->join('productos', 'movimientos.producto_id', '=', 'productos.id')
            ->orderBy('productos.precio', $direction)
            ->select('movimientos.*');
    }

    static public function obtener_precio_total($query)
    {
        return $query->select('movimientos.*', 'productos.nombre_producto', DB::raw('productos.precio * movimientos.cantidad as precio_total'))
            ->join('productos', 'movimientos.producto_id', '=', 'productos.id');
    }
}

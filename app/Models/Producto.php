<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre_producto',
        'descripcion',
        'stock_actual',
        'precio',
        'imagen_url',
        'activo',
        'categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function movimiento()
    {
        return $this->hasMany(Movimiento::class);
    }


    // Método de búsqueda y ordenamiento
    static public function busqueda($request, $query) {
        if ($request->has('search')) {
            $query->where('nombre_producto', 'like', '%'.$request->search.'%');
        }

        // Ordenamiento
        switch ($request->ordering) {
            case 'recientes':
                $query->orderBy('created_at', 'desc');
                break;
            case 'nombre_asc':
                $query->orderBy('nombre_producto', 'asc');
                break;
            case 'nombre_desc':
                $query->orderBy('nombre_producto', 'desc');
                break;
            case 'precio_asc':
                $query->orderBy('precio', 'asc');
                break;
            case 'precio_desc':
                $query->orderBy('precio', 'desc');
                break;
            case 'stock_asc':
                $query->orderBy('stock_actual', 'asc');
                break;
            case 'stock_desc':
                $query->orderBy('stock_actual', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Paginación con parámetros persistentes
        return $query->paginate(10)->appends($request->only(['search', 'ordering']));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orden extends Model
{
    use HasFactory;

    protected $table = 'ordenes';

    protected $fillable = [
        'user_id',
        'token_sesion',
        'buy_order',
        'monto_total',
        'estado',
    ];

    public function items()
    {
        return $this->hasMany(ItemOrden::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

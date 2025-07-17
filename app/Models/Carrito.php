<?php

namespace App\Models;

use App\Models\ItemCarrito;
use App\Models\User;
use App\Models\Orden;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $fillable = ['user_id', 'token'];

    public function items()
    {
        return $this->hasMany(ItemCarrito::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

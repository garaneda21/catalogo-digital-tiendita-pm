<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class Administrador extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\AdministradorFactory> */
    use HasFactory;

    protected $table = 'administradores';

    protected $fillable = [
        'nombre_admin',
        'correo_admin',
        'password',
    ];

    public function permisos()
    {
        return $this->belongsToMany(Permisos::class, 'permisos_admins')->withPivot('activo');
    }

    public function tienePermiso(string $nombre)
    {
        return $this->permisos->contains('nombre_permiso', $nombre);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * Obtener iniciales del Admin
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }
}

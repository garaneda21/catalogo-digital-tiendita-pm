<?php

namespace App\Policies;

use App\Models\Administrador;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Ver Todos Los Usuarios');
    }

    public function view(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Ver Detalles De Un Usuario');
    }

    public function create(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Crear Usuarios');
    }

    public function update(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Editar Usuarios');
    }

    public function disable(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Desactivar Usuarios');
    }

    public function delete(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Eliminar Usuarios');
    }
}

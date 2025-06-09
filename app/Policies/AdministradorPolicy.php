<?php

namespace App\Policies;

use App\Models\Administrador;

class AdministradorPolicy
{
    public function viewAny(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Ver Todos Los Admin');
    }

    public function view(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Ver Datos De Un Admin');
    }

    public function create(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Crear Admin');
    }

    public function update(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Editar Admin');
    }

    public function update_permisos(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Editar Permisos Admin');
    }

    public function disable(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Desactivar Admin');
    }

    public function delete(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Eliminar Admin');
    }
}

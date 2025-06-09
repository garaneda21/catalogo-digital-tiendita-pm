<?php

namespace App\Policies;

use App\Models\Administrador;
use App\Models\Producto;
use Illuminate\Auth\Access\Response;

class ProductoPolicy
{
    public function viewAny(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Ver Todos Los Productos');
    }

    public function create(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Crear Productos');
    }

    public function update(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Editar Productos');
    }

    public function delete(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Eliminar Productos');
    }
}

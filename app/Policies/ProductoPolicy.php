<?php

namespace App\Policies;

use App\Models\Administrador;
use App\Models\Producto;
use Illuminate\Auth\Access\Response;

class ProductoPolicy
{
    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Ver Todos Los Productos');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Crear Productos');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Editar Productos');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Eliminar Productos');
    }
}

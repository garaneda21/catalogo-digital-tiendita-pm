<?php

namespace App\Policies;

use App\Models\Producto;
use App\Models\Administrador;
use Illuminate\Auth\Access\Response;

class ProductoPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(Administrador $admin, Producto $producto): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Administrador $admin): bool
    {
        return $admin->tienePermiso('crear_productos');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Administrador $admin, Producto $producto): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Administrador $admin, Producto $producto): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Administrador $admin, Producto $producto): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Administrador $admin, Producto $producto): bool
    {
        return false;
    }
}

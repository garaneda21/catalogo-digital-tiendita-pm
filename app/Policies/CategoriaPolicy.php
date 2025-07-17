<?php

namespace App\Policies;

use App\Models\Administrador;
use App\Models\Categoria;

class CategoriaPolicy
{
    public function viewAny(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Ver Todas Las Categorias');
    }

    public function create(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Crear Categorias');
    }

    public function update(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Editar Categorias');
    }

    public function delete(Administrador $admin): bool
    {
        return $admin->tiene_permiso('Eliminar Categorias');
    }
}

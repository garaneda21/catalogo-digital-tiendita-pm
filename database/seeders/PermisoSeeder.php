<?php

namespace Database\Seeders;

use App\Models\Permisos;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            // Permisos de Productos
            ['nombre_permiso' => 'Ver Todos Los Productos', 'categoria_permiso' => 'Productos'],
            ['nombre_permiso' => 'Ver Un Producto', 'categoria_permiso' => 'Productos'],
            ['nombre_permiso' => 'Crear Productos', 'categoria_permiso' => 'Productos'],
            ['nombre_permiso' => 'Editar Productos', 'categoria_permiso' => 'Productos'],
            ['nombre_permiso' => 'Eliminar Productos', 'categoria_permiso' => 'Productos'],

            // Permisos de Admin
            ['nombre_permiso' => 'Ver Todos Los Admin', 'categoria_permiso' => 'Admin'],
            ['nombre_permiso' => 'Ver Detalles De Un Admin', 'categoria_permiso' => 'Admin'],
            ['nombre_permiso' => 'Crear Admin', 'categoria_permiso' => 'Admin'],
            ['nombre_permiso' => 'Editar Admin', 'categoria_permiso' => 'Admin'],
            ['nombre_permiso' => 'Editar Permisos Admin', 'categoria_permiso' => 'Admin'],
            ['nombre_permiso' => 'Desactivar Admin', 'categoria_permiso' => 'Admin'],
            ['nombre_permiso' => 'Eliminar Admin', 'categoria_permiso' => 'Admin'],

            // Permisos de Categorias
            ['nombre_permiso' => 'Ver Todas Las Categorias', 'categoria_permiso' => 'Categorias'],
            ['nombre_permiso' => 'Crear Categorias', 'categoria_permiso' => 'Categorias'],
            ['nombre_permiso' => 'Editar Categorias', 'categoria_permiso' => 'Categorias'],
            ['nombre_permiso' => 'Eliminar Categorias', 'categoria_permiso' => 'Categorias'],
        ];

        foreach ($permisos as $permiso) {
            Permisos::create($permiso);
        }
    }
}

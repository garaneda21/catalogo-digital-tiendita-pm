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
            ['nombre_permiso' => 'Crear Productos', 'categoria_permiso' => 'Productos'],
            ['nombre_permiso' => 'Editar Productos', 'categoria_permiso' => 'Productos'],
            ['nombre_permiso' => 'Eliminar Productos', 'categoria_permiso' => 'Productos'],

            ['nombre_permiso' => 'Crear Administradores', 'categoria_permiso' => 'Admins'],
            ['nombre_permiso' => 'Editar Administradores', 'categoria_permiso' => 'Admins'],
            ['nombre_permiso' => 'Eliminar Administradores', 'categoria_permiso' => 'Admins'],
        ];

        foreach ($permisos as $permiso) {
            Permisos::create($permiso);
        }
    }
}

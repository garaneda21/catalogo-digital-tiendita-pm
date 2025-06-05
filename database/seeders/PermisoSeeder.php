<?php

namespace Database\Seeders;

use App\Models\Permisos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            ['nombre_permiso' => 'Puede crear productos'],
        ];

        foreach ($permisos as $permiso) {
            Permisos::create($permiso);
        }
    }
}

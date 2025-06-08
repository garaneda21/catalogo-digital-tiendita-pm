<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Permisos;
use App\Models\PermisosAdmin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisosAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = Permisos::all();
        $admin = Administrador::where('id', 1)->get()->first();

        foreach ($permisos as $permiso) {
            PermisosAdmin::create([
                'administrador_id' => $admin->id,
                'permisos_id'      => $permiso->id,
            ]);
        }
    }
}

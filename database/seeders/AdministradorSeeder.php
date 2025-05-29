<?php

namespace Database\Seeders;

use App\Models\Administrador;
use Illuminate\Database\Seeder;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Administrador::create([
            'nombre_admin' => 'Admin',
            'correo_admin' => 'admin@admin.com',
            'password'     => bcrypt('admin123'),
        ]);
    }
}

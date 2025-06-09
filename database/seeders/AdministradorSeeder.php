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
            'nombre_admin' => 'SuperAdmin',
            'correo_admin' => env('ADMIN_MAIL'),
            'password'     => bcrypt(env('ADMIN_PASSWORD')),
            'activo'       => true,
            'superadmin'   => true,
        ]);
    }
}

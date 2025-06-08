<?php

namespace Database\Seeders;

use App\Models\Accion;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(PermisoSeeder::class);
        $this->call(AdministradorSeeder::class);
        $this->call(PermisosAdminSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(AccionSeeder::class);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Accion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $acciones = [
            ['nombre_accion' => 'Inicia sesión'],
            ['nombre_accion' => 'Cierra sesión'],
            ['nombre_accion' => 'Crea nuevo producto'],
            ['nombre_accion' => 'Edita un producto'],
            ['nombre_accion' => 'Crea un nuevo admin'],
            ['nombre_accion' => 'Edita los datos de un admin'],
        ];

        foreach ($acciones as $accion) {
            Accion::create($accion);
        }
    }
}

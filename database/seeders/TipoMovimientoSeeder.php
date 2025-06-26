<?php

namespace Database\Seeders;

use App\Models\TipoMovimiento;
use Illuminate\Database\Seeder;

class TipoMovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            ['nombre_tipo' => 'salida'],    //id = 1
            ['nombre_tipo' => 'entrada'],   //id = 2
            ['nombre_tipo' => 'ajuste'],    //id = 3
            // ...
        ];

        foreach ($tipos as $tipo) {
            TipoMovimiento::create($tipo);
        }
    }
}

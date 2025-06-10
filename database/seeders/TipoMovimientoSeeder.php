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
            ['nombre_tipo' => 'salida'],
            ['nombre_tipo' => 'entrada'],
            ['nombre_tipo' => 'ajuste'],
            // ...
        ];

        foreach ($tipos as $tipo) {
            TipoMovimiento::create($tipo);
        }
    }
}

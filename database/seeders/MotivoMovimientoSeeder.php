<?php

namespace Database\Seeders;

use App\Models\MotivoMovimiento;
use Illuminate\Database\Seeder;

class MotivoMovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $motivos = [
            [
                'nombre_motivo' => 'Venta por WhatsApp',
                'tipo_movimiento_id' => 1
            ],
            [
                'nombre_motivo' => 'Compra proveedor',
                'tipo_movimiento_id' => 2
            ],
            [
                'nombre_motivo' => 'Devolución de cliente',
                'tipo_movimiento_id' => 2
            ],
            [
                'nombre_motivo' => 'Ingreso general',
                'tipo_movimiento_id' => 2
            ],
            [
                'nombre_motivo' => 'Venta Web',
                'tipo_movimiento_id' => 1
            ],
            // ...
        ];

        foreach ($motivos as $motivo) {
            MotivoMovimiento::create($motivo);
        }
    }
}

<?php

use App\Models\TipoMovimiento;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('motivo_movimientos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_motivo');
            $table->foreignIdFor(TipoMovimiento::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motivo_movimientos');
    }
};

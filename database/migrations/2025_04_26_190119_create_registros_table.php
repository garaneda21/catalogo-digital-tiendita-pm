<?php

use App\Models\Accion;
use App\Models\Producto;
use App\Models\Administrador;

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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Accion::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Producto::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Administrador::class)->constrained()->cascadeOnDelete();
            $table->dateTime('fecha_hora');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};

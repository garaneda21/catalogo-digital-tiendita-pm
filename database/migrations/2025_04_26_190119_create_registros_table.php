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
            $table->bigInteger('id_entidad_modificada')->nullable();
            $table->string('entidad_modificada')->nullable();
            $table->dateTime('fecha_registro');
            $table->foreignIdFor(Accion::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Administrador::class)->constrained()->cascadeOnDelete();
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

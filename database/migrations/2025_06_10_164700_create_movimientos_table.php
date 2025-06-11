<?php

use App\Models\Producto;
use App\Models\MotivoMovimiento;
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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad')->unsigned();
            $table->foreignIdFor(Producto::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(TipoMovimiento::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(MotivoMovimiento::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};

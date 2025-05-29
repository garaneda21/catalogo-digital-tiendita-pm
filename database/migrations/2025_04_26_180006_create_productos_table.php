<?php

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_producto', 250);
            $table->text('descripcion')->nullable();
            $table->integer('stock_actual', false, true)->default(0);
            $table->integer('precio')->default(0);
            $table->string('imagen_url', 500)->nullable();
            $table->boolean('estado_producto')->default(1);
            $table->foreignIdFor(Categoria::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};

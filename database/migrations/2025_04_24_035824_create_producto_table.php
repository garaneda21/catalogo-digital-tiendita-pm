<?php

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
        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_producto', 250);
            $table->text('descripcion')->nullable();
            $table->integer('stock_actual')->unsigned()->default(0);
            $table->decimal('precio', 12, 2)->default(0.00);
            $table->string('imagen_url', 500)->nullable();
            $table->foreignId('id_estado')->constrained('estado')->onDelete('cascade');
            $table->foreignId('id_categoria')->constrained('categoria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};

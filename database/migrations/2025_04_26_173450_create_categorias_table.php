<?php

// NOTE: Ver si dejar o eliminar

use Illuminate\Support\Facades\DB;

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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_categoria', 250);
            $table->text('descripcion_categoria')->nullable();
        });

        DB::table('categorias')->insert([
            ['nombre_categoria' => 'Perfumes'],
            ['nombre_categoria' => 'Skincare'],
            ['nombre_categoria' => 'Maquillaje'],
            ['nombre_categoria' => 'Ropa'],
            ['nombre_categoria' => 'Carteras'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};

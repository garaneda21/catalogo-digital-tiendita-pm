<?php

// NOTE: Ver si dejar o eliminar

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_categoria', 250)->unique();
            $table->string('slug', 250)->unique();
            $table->text('descripcion_categoria')->nullable();
        });

        DB::table('categorias')->insert([
            ['nombre_categoria' => 'Perfumes', 'slug' => Str::slug('Perfumes')],
            ['nombre_categoria' => 'Skincare', 'slug' => Str::slug('Skincare')],
            ['nombre_categoria' => 'Maquillaje', 'slug' => Str::slug('Maquillaje')],
            ['nombre_categoria' => 'Ropa', 'slug' => Str::slug('Ropa')],
            ['nombre_categoria' => 'Carteras', 'slug' => Str::slug('Carteras')],
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

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
        Schema::create('configuracion', function (Blueprint $table) {
            $table->id('id_config')->unsigned();
            $table->string('numero_whatsapp', 20);
            $table->string('nombre_tienda', 100);
            $table->string('seo_keywords', 250)->nullable();
            $table->text('seo_descriptions')->nullable();
            $table->primary('id_config');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracion');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accion', function (Blueprint $table) {
            $table->id('id_accion')->unsigned();  // Define un ID auto-incremental y sin signo
            $table->integer('nombre_accion')->unsigned();  // Define un entero sin signo
            $table->primary('id_accion');  // Define la clave primaria
        });
    }

    /**
     * Revertir las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accion');
    }
};

<?php

use App\Models\Administrador;
use App\Models\Permisos;
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
        Schema::create('permisos_admins', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Administrador::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Permisos::class)->constrained()->cascadeOnDelete();
            $table->boolean('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos_admins');
    }
};

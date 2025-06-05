<?php

use App\Models\Categoria;
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
        });

        DB::table('productos')->insert(
            [
                [
                    'nombre_producto' => 'Perfume Floral',
                    'descripcion' => 'Fragancia suave con notas florales.',
                    'stock_actual' => 15,
                    'precio' => 25990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 1,
                ],
                [
                    'nombre_producto' => 'Perfume Amaderado',
                    'descripcion' => 'Aroma intenso con notas de madera y cuero.',
                    'stock_actual' => 10,
                    'precio' => 29990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 1,
                ],
                [
                    'nombre_producto' => 'Sérum Hidratante',
                    'descripcion' => 'Ideal para piel seca, con ácido hialurónico.',
                    'stock_actual' => 25,
                    'precio' => 14990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 2,
                ],
                [
                    'nombre_producto' => 'Crema Antiedad',
                    'descripcion' => 'Reduce líneas de expresión en 4 semanas.',
                    'stock_actual' => 18,
                    'precio' => 17990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 2,
                ],
                [
                    'nombre_producto' => 'Base Líquida Mate',
                    'descripcion' => 'Cobertura total con acabado profesional.',
                    'stock_actual' => 12,
                    'precio' => 10990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 3,
                ],
                [
                    'nombre_producto' => 'Paleta de Sombras Nude',
                    'descripcion' => 'Colores tierra, ideal para uso diario.',
                    'stock_actual' => 20,
                    'precio' => 8990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 3,
                ],
                [
                    'nombre_producto' => 'Polera Oversize Blanca',
                    'descripcion' => '100% algodón, cómoda y fresca.',
                    'stock_actual' => 30,
                    'precio' => 12990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 4,
                ],
                [
                    'nombre_producto' => 'Pantalón Cargo Verde',
                    'descripcion' => 'Estilo urbano, múltiples bolsillos.',
                    'stock_actual' => 14,
                    'precio' => 19990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 4,
                ],
                [
                    'nombre_producto' => 'Cartera Negra Clásica',
                    'descripcion' => 'Diseño elegante para uso diario.',
                    'stock_actual' => 10,
                    'precio' => 24990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 5,
                ],
                [
                    'nombre_producto' => 'Cartera Animal Print',
                    'descripcion' => 'Estilo atrevido con textura animal print.',
                    'stock_actual' => 8,
                    'precio' => 26990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 5,
                ],
                // 10 productos más con variedad para completar los 20
                [
                    'nombre_producto' => 'Perfume Cítrico',
                    'descripcion' => 'Fragancia fresca con notas de naranja y limón.',
                    'stock_actual' => 11,
                    'precio' => 23990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 1,
                ],
                [
                    'nombre_producto' => 'Perfume Dulce',
                    'descripcion' => 'Aroma dulce y juvenil, ideal para el día.',
                    'stock_actual' => 17,
                    'precio' => 21990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 1,
                ],
                [
                    'nombre_producto' => 'Gel Facial Limpiador',
                    'descripcion' => 'Elimina impurezas sin resecar la piel.',
                    'stock_actual' => 22,
                    'precio' => 8990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 2,
                ],
                [
                    'nombre_producto' => 'Tónico Facial Revitalizante',
                    'descripcion' => 'Refresca la piel después de la limpieza.',
                    'stock_actual' => 19,
                    'precio' => 7990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 2,
                ],
                [
                    'nombre_producto' => 'Labial Mate Rojo',
                    'descripcion' => 'Color intenso y larga duración.',
                    'stock_actual' => 16,
                    'precio' => 6990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 3,
                ],
                [
                    'nombre_producto' => 'Delineador Líquido Negro',
                    'descripcion' => 'Trazo preciso para maquillaje definido.',
                    'stock_actual' => 18,
                    'precio' => 5990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 3,
                ],
                [
                    'nombre_producto' => 'Chaqueta Jeans Azul',
                    'descripcion' => 'Clásico denim para toda ocasión.',
                    'stock_actual' => 12,
                    'precio' => 22990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 4,
                ],
                [
                    'nombre_producto' => 'Vestido Largo Floral',
                    'descripcion' => 'Fresco y ligero, ideal para verano.',
                    'stock_actual' => 9,
                    'precio' => 19990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 4,
                ],
                [
                    'nombre_producto' => 'Cartera Crossbody Café',
                    'descripcion' => 'Práctica y cómoda para el día a día.',
                    'stock_actual' => 13,
                    'precio' => 18990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 5,
                ],
                [
                    'nombre_producto' => 'Cartera Mini Beige',
                    'descripcion' => 'Compacta y con estilo minimalista.',
                    'stock_actual' => 6,
                    'precio' => 15990,
                    'imagen_url' => null,
                    'estado_producto' => 1,
                    'categoria_id' => 5,
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};

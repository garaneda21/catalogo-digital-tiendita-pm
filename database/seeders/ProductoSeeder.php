<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = [
            [
                'nombre_producto' => 'Perfume Floral',
                'slug' => Str::slug('Perfume Floral'),
                'descripcion'     => 'Fragancia suave con notas florales.',
                'stock_actual'    => 15,
                'precio'          => 25990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 1,
            ],
            [
                'nombre_producto' => 'Perfume Amaderado',
                'slug' => Str::slug('Perfume Amaderado'),
                'descripcion'     => 'Aroma intenso con notas de madera y cuero.',
                'stock_actual'    => 10,
                'precio'          => 29990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 1,
            ],
            [
                'nombre_producto' => 'Sérum Hidratante',
                'slug' => Str::slug('Sérum Hidratante'),
                'descripcion'     => 'Ideal para piel seca, con ácido hialurónico.',
                'stock_actual'    => 25,
                'precio'          => 14990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 2,
            ],
            [
                'nombre_producto' => 'Crema Antiedad',
                'slug' => Str::slug('Crema Antiedad'),
                'descripcion'     => 'Reduce líneas de expresión en 4 semanas.',
                'stock_actual'    => 18,
                'precio'          => 17990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 2,
            ],
            [
                'nombre_producto' => 'Base Líquida Mate',
                'slug' => Str::slug('Base Líquida Mate'),
                'descripcion'     => 'Cobertura total con acabado profesional.',
                'stock_actual'    => 12,
                'precio'          => 10990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 3,
            ],
            [
                'nombre_producto' => 'Paleta de Sombras Nude',
                'slug' => Str::slug('Paleta de Sombras Nude'),
                'descripcion'     => 'Colores tierra, ideal para uso diario.',
                'stock_actual'    => 20,
                'precio'          => 8990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 3,
            ],
            [
                'nombre_producto' => 'Polera Oversize Blanca',
                'slug' => Str::slug('Polera Oversize Blanca'),
                'descripcion'     => '100% algodón, cómoda y fresca.',
                'stock_actual'    => 30,
                'precio'          => 12990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 4,
            ],
            [
                'nombre_producto' => 'Pantalón Cargo Verde',
                'slug' => Str::slug('Pantalón Cargo Verde'),
                'descripcion'     => 'Estilo urbano, múltiples bolsillos.',
                'stock_actual'    => 14,
                'precio'          => 19990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 4,
            ],
            [
                'nombre_producto' => 'Cartera Negra Clásica',
                'slug' => Str::slug('Cartera Negra Clásica'),
                'descripcion'     => 'Diseño elegante para uso diario.',
                'stock_actual'    => 10,
                'precio'          => 24990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 5,
            ],
            [
                'nombre_producto' => 'Cartera Animal Print',
                'slug' => Str::slug('Cartera Animal Print'),
                'descripcion'     => 'Estilo atrevido con textura animal print.',
                'stock_actual'    => 8,
                'precio'          => 26990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 5,
            ],
            // 10 productos más con variedad para completar los 20
            [
                'nombre_producto' => 'Perfume Cítrico',
                'slug' => Str::slug('Perfume Cítrico'),
                'descripcion'     => 'Fragancia fresca con notas de naranja y limón.',
                'stock_actual'    => 11,
                'precio'          => 23990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 1,
            ],
            [
                'nombre_producto' => 'Perfume Dulce',
                'slug' => Str::slug('Perfume Dulce'),
                'descripcion'     => 'Aroma dulce y juvenil, ideal para el día.',
                'stock_actual'    => 17,
                'precio'          => 21990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 1,
            ],
            [
                'nombre_producto' => 'Gel Facial Limpiador',
                'slug' => Str::slug('Gel Facial Limpiador'),
                'descripcion'     => 'Elimina impurezas sin resecar la piel.',
                'stock_actual'    => 22,
                'precio'          => 8990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 2,
            ],
            [
                'nombre_producto' => 'Tónico Facial Revitalizante',
                'slug' => Str::slug('Tónico Facial Revitalizante'),
                'descripcion'     => 'Refresca la piel después de la limpieza.',
                'stock_actual'    => 19,
                'precio'          => 7990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 2,
            ],
            [
                'nombre_producto' => 'Labial Mate Rojo',
                'slug' => Str::slug('Labial Mate Rojo'),
                'descripcion'     => 'Color intenso y larga duración.',
                'stock_actual'    => 16,
                'precio'          => 6990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 3,
            ],
            [
                'nombre_producto' => 'Delineador Líquido Negro',
                'slug' => Str::slug('Delineador Líquido Negro'),
                'descripcion'     => 'Trazo preciso para maquillaje definido.',
                'stock_actual'    => 18,
                'precio'          => 5990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 3,
            ],
            [
                'nombre_producto' => 'Chaqueta Jeans Azul',
                'slug' => Str::slug('Chaqueta Jeans Azul'),
                'descripcion'     => 'Clásico denim para toda ocasión.',
                'stock_actual'    => 12,
                'precio'          => 22990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 4,
            ],
            [
                'nombre_producto' => 'Vestido Largo Floral',
                'slug' => Str::slug('Vestido Largo Floral'),
                'descripcion'     => 'Fresco y ligero, ideal para verano.',
                'stock_actual'    => 9,
                'precio'          => 19990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 4,
            ],
            [
                'nombre_producto' => 'Cartera Crossbody Café',
                'slug' => Str::slug('Cartera Crossbody Café'),
                'descripcion'     => 'Práctica y cómoda para el día a día.',
                'stock_actual'    => 13,
                'precio'          => 18990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 5,
            ],
            [
                'nombre_producto' => 'Cartera Mini Beige',
                'slug' => Str::slug('Cartera Mini Beige'),
                'descripcion'     => 'Compacta y con estilo minimalista.',
                'stock_actual'    => 6,
                'precio'          => 15990,
                'imagen_url'      => null,
                'activo' => 1,
                'categoria_id'    => 5,
            ],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}

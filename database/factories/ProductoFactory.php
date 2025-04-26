<?php

namespace Database\Factories;

use Faker\Provider\Lorem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_producto' => fake()->name(),
            'descripcion' => Lorem::text(),
            'stock_actual' => fake()->numberBetween(0, 10),
            'precio' => fake()->numberBetween(10000, 250000),
            'imagen_url' => null,
            'categoria_id' => fake()->numberBetween(1,3),
        ];
    }
}

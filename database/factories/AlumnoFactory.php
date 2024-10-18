<?php

namespace Database\Factories;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumno>
 */
class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'noctrl' => fake()->unique()->bothify("########"),
            'nombre' => fake()->name(),
            'apellidop' => fake()->lastName(),
            'apellidom' => fake()->lastName(),
            'sexo' => fake()->randomElement(['M','F']),
            'carrera_id'=>Carrera::factory()
        ];
    }
}

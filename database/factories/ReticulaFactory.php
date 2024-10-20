<?php

namespace Database\Factories;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reticula>
 */
class ReticulaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idreticula' => $this->faker->unique()->bothify('RET###'),
            'descripcion' => $this->faker->sentence(6, true),
            'fechavigor' => $this->faker->dateTimeBetween('-1 years', '+1 years')->format('Y-m-d'),
            'carrera_id' => Carrera::inRandomOrder()->first()->id,
        ];
    }
}

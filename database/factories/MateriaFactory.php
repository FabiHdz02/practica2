<?php

namespace Database\Factories;

use App\Models\Reticula;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Materia>
 */
class MateriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idmateria' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{8}'),
            'nombremateria' => $this->faker->unique()->sentence(3),
            'nivel' => $this->faker->randomElement(['1', '2', '3', '4']),
            'nombrecorto' => $this->faker->unique()->word(),
            'modalidad' => $this->faker->randomElement(['E', 'L']),
            'reticula_id' => Reticula::all()->random()->id,
        ];
    }
}

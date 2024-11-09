<?php

namespace Database\Factories;

use App\Models\Plaza;
use App\Models\Personal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalPlaza>
 */
class PersonalPlazaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tiponombramiento' => $this->faker->randomElement([1, 2, 3]),
            'plaza_id' => Plaza::inRandomOrder()->first()->id,
            'personal_id' => Personal::inRandomOrder()->first()->id,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plaza>
 */
class PlazaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array 
{ 
    // Lista de plazas
    static $indice = -1; 
    $indice++;
    
    $plazas = ["E3817", "E3815", "E3717", "E3617", "E3520"];
    
    return [
        'idplaza' => $plazas[$indice % count($plazas)], // Asignar plaza de forma cíclica
        'nombreplaza' => $this->faker->sentence(10),
    ]; 
}
}

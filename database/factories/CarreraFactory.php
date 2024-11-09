<?php

namespace Database\Factories;

use App\Models\Depto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carrera>
 */
class CarreraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $carreras = [
            "Contador Público",
            "Ing. en Logística",
            "Ing. Electrónica",
            "Ing. Mecánica",
            "Ing. Mecatrónica",
            "Ing. en Sistemas Computacionales",
            "Ing. Industrial",
            "Ing. en Gestión Empresarial"
        ];
    
        static $indice = -1;
        $indice++;
    
        return [
            "idcarrera" => fake()->unique()->bothify("????####"),
            "nombrecarrera" => $carreras[$indice],
            "nombremediano" => fake()->lexify(str_repeat("?", 15)),
            "nombrecorto" => substr($carreras[$indice], 0, 5),
            "depto_id" => Depto::inRandomOrder()->first()->id  // Selecciona un depto_id aleatorio
        ];
    }
    
}

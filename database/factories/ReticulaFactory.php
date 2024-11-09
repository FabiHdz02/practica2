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
        // Definir las retículas con las carreras especificadas
        static $indice = -1;
        $indice++;

        // Arreglo de retículas
        $reticulas = [
            ['RET01', 'Retícula Contador Público', '2024-01-01', '2026-01-01'],
            ['RET02', 'Retícula Ing. en Logística', '2024-02-01', '2026-02-01'],
            ['RET03', 'Retícula Ing. Electrónica', '2024-03-01', '2026-03-01'],
            ['RET04', 'Retícula Ing. Mecánica', '2024-04-01', '2026-04-01'],
            ['RET05', 'Retícula Ing. Mecatrónica', '2024-05-01', '2026-05-01'],
            ['RET06', 'Retícula Ing. en Sistemas Computacionales', '2024-06-01', '2026-06-01'],
            ['RET07', 'Retícula Ing. Industrial', '2024-07-01', '2026-07-01'],
            ['RET08', 'Retícula Ing. en Gestión Empresarial', '2024-08-01', '2026-08-01'],
        ];

        // Reiniciar el índice si se supera el número de carreras (8 en este caso)
        if ($indice >= count($reticulas)) {
            $indice = 0;
        }

        return [
            'idreticula' => $reticulas[$indice][0], // ID de la retícula
            'descripcion' => $reticulas[$indice][1], // Descripción de la retícula
            'fechavigor' => $reticulas[$indice][2], // Fecha de vigencia
            "carrera_id" => Carrera::inRandomOrder()->first()->id
        ];
    }
}

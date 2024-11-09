<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hora>
 */
class HoraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Definimos los periodos de las clases, de 7:00 AM a 10:00 PM
        static $horas = -1;
        $horas++;
        
        // Define los periodos de las clases
        $hr = [
            ['07:00', '08:00'],
            ['08:00', '09:00'],
            ['09:00', '10:00'],
            ['10:00', '11:00'],
            ['11:00', '12:00'],
            ['12:00', '13:00'],
            ['13:00', '14:00'],
            ['14:00', '15:00'],
            ['15:00', '16:00'],
            ['16:00', '17:00'],
            ['17:00', '18:00'],
            ['18:00', '19:00'],
            ['19:00', '20:00'],
            ['20:00', '21:00'],
            ['21:00', '22:00'],
        ];

        // Si llegamos al final del array de periodos, volvemos al principio
        if ($horas >= count($hr)) {
            $horas = 0;
        }

        // Obtiene el periodo de la clase basado en la variable $horas
        $hr = $hr[$horas];

        return [
            'hora_ini' => $hr[0],
            'hora_fin' => $hr[1],
        ];
    }
}

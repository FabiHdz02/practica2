<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Depto>
 */
class DeptoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Array con los departamentos definidos
        $departamentos = [
            "Direccion", 
            "Subdireccion",
            "ISC", 
            "IE", 
            "IM", 
            "IME", 
            "CP", 
            "IGE", 
            "II", 
            "Ciencias Basicas"
        ];

        // Asignar un nombre aleatorio de la lista de departamentos
        static $indice = -1;
        $indice++;

        return [
            'iddepto' => fake()->unique()->bothify("?#"),  // Generación de ID único
            'nombredepto' => $departamentos[$indice % count($departamentos)],  // Asigna el nombre del departamento según el índice
            'nombremediano' => fake()->unique()->lexify(str_repeat("?", 15)),  // Nombre mediano aleatorio
            'nombrecorto' => substr($departamentos[$indice % count($departamentos)], 0, 5)  // Nombre corto (primeros 5 caracteres del nombre del departamento)
        ];
    }

}

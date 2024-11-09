<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Puesto>
 */
class PuestoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $indice = -1;
        $indice++;
    
        $puestos = [
            ['Docente', 'DOC01', 'Docente'],             // Docente
            ['Director', 'DIR01', 'Direccion'],
            ['Subdirector académico', 'DIR02', 'Direccion'],
            ['Subdirector de plantación', 'DIR03', 'Direccion'],
            ['Auxiliar de laboratorio', 'AUX01', 'Auxiliar'],
            ['Auxiliar de biblioteca', 'AUX02', 'Auxiliar'],
            ['Auxiliar de taller', 'AUX03', 'Auxiliar'],
            ['Jefe de recursos humanos', 'ADM01', 'Administrativo'],
            ['Jefe académico', 'ADM02', 'Administrativo'],
            ['Jefe división de estudiosos', 'ADM03', 'Administrativo'],
            ['No Docente', 'ND01', 'Administrativo'],       // Nuevo puesto: No Docente
        ];
    
        return [
            'nombre' => $puestos[$indice][0],    // Nombre del puesto
            'idpuesto' => $puestos[$indice][1],   // ID del puesto
            'tipo' => $puestos[$indice][2],       // Tipo de puesto
        ];
    }    
}

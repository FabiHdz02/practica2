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
        static $indice = -1; 
        $indice++; 
        
        // Lista de alumnos
        $estudiantes = [ 
            ['Angel Javier', 'Marin', 'Ochoa', '21430347'], 
            ['Santiago Yarik', 'Andrade', 'Garcia', '21430322'], 
            ['Issac', 'Sanchez', 'Lezama', '21430366'], 
            ['Samuel Alejandro', 'Perales', 'Delgado', '21430356'], 
            ['Juanalberto', 'Aguirre', 'Cruz', '21430318'], 
            ['Yessica Azeneth', 'Cervantes', 'Vara', '21430330'], 
            ['Jose Julio', 'Duran', 'Villa', '21430334'], 
            ['Carlo', 'Lara', 'Garcia', '21430345'], 
            ['Ernesto', 'Marquez', 'De Los Reyes', '21430348'], 
            ['Israel Emmanuel', 'Reyna', 'Lopez', '21430360'], 
            ['Michelle Alejandra', 'Esquivel', 'Mendez', '21430337'], 
            ['Roberto Isaac', 'Alvarado', 'Garcia', '21430320'], 
            ['Luis', 'Reyes', 'Vielma', '21430359'], 
            ['Juan Antonio', 'Castilla', 'Orta', '21430327'], 
            ['Juarez Sanchez Eduardo Antonio', '', '', '19430300'], 
            ['Fernando', 'Hernandez', 'Alvarez', '21430344'], 
            ['Elias Arnulfo', 'Morales', 'Garcia', '20430054'], 
            ['Angel De Jesus', 'Sanchez', 'Lopez', '21430370'], 
            ['Keren Adriana', 'Escobar', 'Castilleja', '21430336'], 
            ['Juan Yarik', 'Fuentes', 'Sierra', '21430338'], 
        ]; 
    
        // Obtener las carreras disponibles
        $carreras = Carrera::all()->take(5); // Tomamos las primeras 5 carreras disponibles
    
        // Asignar los alumnos de manera cíclica a cada carrera
        return [ 
            'noctrl' => $estudiantes[$indice][3], 
            'nombre' => $estudiantes[$indice][0], 
            'apellidop' => $estudiantes[$indice][1], 
            'apellidom' => $estudiantes[$indice][2], 
            'sexo' => fake()->randomElement(['M', 'F']), 
            'semestre' => fake()->numberBetween(1, 9), // Generar un semestre entre 1 y 10
            'carrera_id' => $carreras[$indice % count($carreras)]->id, // Asignar carrera de forma cíclica
        ]; 
    }    

}

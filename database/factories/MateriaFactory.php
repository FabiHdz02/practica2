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
        static $indiceISC = 0;
        static $indiceIndustrial = 0;
    
        // Materias por retícula, con semestre incluido
        $materias = [
            'ISC' => [
                ['semestre' => 1, 'materias' => ['Taller de Ética', 'Fundamentos de Programación', 'Cálculo Diferencial']],
                ['semestre' => 2, 'materias' => ['Cálculo Integral', 'Programación Orientada a Objetos', 'Álgebra Lineal']],
                ['semestre' => 3, 'materias' => ['Desarrollo Sustentable', 'Estructura de Datos', 'Cálculo Vectorial']],
                ['semestre' => 4, 'materias' => ['Taller de Sistemas Operativos', 'Fundamentos de Bases de Datos', 'Tópicos Avanzados de Programación']],
                ['semestre' => 5, 'materias' => ['Arquitectura de Computadoras', 'Fundamentos de Ingeniería de Software', 'Taller de Bases de Datos']],
                ['semestre' => 6, 'materias' => ['Ingeniería de Software', 'Administración de Bases de Datos', 'Programación Web']],
                ['semestre' => 7, 'materias' => ['Programación Web II', 'Taller de Investigación I', 'Cultura Empresarial']],
                ['semestre' => 8, 'materias' => ['Programación Lógica y Funcional', 'Programación Móvil con Lenguaje Oficial', 'Taller de Investigación II']],
                ['semestre' => 9, 'materias' => ['Residencia Profesional', 'Inteligencia Artificial', 'Programación Móvil Multiplataforma']]
            ],
            'Industrial' => [
                ['semestre' => 1, 'materias' => ['Dibujo Industrial', 'Fundamentos de Investigación']],
                ['semestre' => 2, 'materias' => ['Análisis de la Realidad Nacional', 'Probabilidad y Estadística']],
                ['semestre' => 3, 'materias' => ['Estadística Inferencial I', 'Metrología y Normalización']],
                ['semestre' => 4, 'materias' => ['Procesos de Fabricación', 'Estadística Inferencial II']],
                ['semestre' => 5, 'materias' => ['Gestión de Costos', 'Administración de Proyectos']],
                ['semestre' => 6, 'materias' => ['Taller de Investigación I', 'Simulación']],
                ['semestre' => 7, 'materias' => ['Planeación Financiera', 'Taller de Investigación II']],
                ['semestre' => 8, 'materias' => ['Seminario de Competitividad', 'Tópicos de Calidad']],
                ['semestre' => 9, 'materias' => ['Medición y Mejoramiento de la Productividad', 'Manufactura Integrada Por Computadora']]
            ]
        ];
    
        // Obtener los IDs de las retículas específicas
        $reticulaISC = Reticula::where('idreticula', 'RET06')->first();
        $reticulaIndustrial = Reticula::where('idreticula', 'RET07')->first();
    
        // Crear materias para Ingeniería en Sistemas Computacionales (ISC)
        if ($reticulaISC && $indiceISC < 27) {
            $semestreData = $materias['ISC'][intdiv($indiceISC, 3)];
            $semestre = $semestreData['semestre'];
            $materiaNombre = $semestreData['materias'][$indiceISC % 3];
            $indiceISC++;
    
            return [
                'idmateria' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{8}'),  // 10 caracteres, único
                'nombremateria' => substr($materiaNombre, 0, 200),  // Limita a 200 caracteres
                'nivel' => $this->faker->randomLetter(),  // Genera una letra aleatoria
                'nombrecorto' => substr($this->faker->unique()->word(), 0, 10),  // Limita a 10 caracteres
                'modalidad' => $this->faker->randomElement(['E', 'L']),  // Un solo carácter
                'semestre' => $semestre,  // Campo semestre asignado desde el arreglo
                'reticula_id' => $reticulaISC->id
            ];
        }
    
        // Crear materias para Ingeniería Industrial
        if ($reticulaIndustrial && $indiceIndustrial < 18) {
            $semestreData = $materias['Industrial'][intdiv($indiceIndustrial, 2)];
            $semestre = $semestreData['semestre'];
            $materiaNombre = $semestreData['materias'][$indiceIndustrial % 2];
            $indiceIndustrial++;
    
            return [
                'idmateria' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{8}'),  // 10 caracteres, único
                'nombremateria' => substr($materiaNombre, 0, 200),  // Limita a 200 caracteres
                'nivel' => $this->faker->randomLetter(),  // Genera una letra aleatoria
                'nombrecorto' => substr($this->faker->unique()->word(), 0, 10),  // Limita a 10 caracteres
                'modalidad' => $this->faker->randomElement(['E', 'L']),  // Un solo carácter
                'semestre' => $semestre,  // Campo semestre asignado desde el arreglo
                'reticula_id' => $reticulaIndustrial->id
            ];
        }
    
        return [];
    }
}

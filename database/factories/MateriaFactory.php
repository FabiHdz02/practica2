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
                ['semestre' => 1, 'materias' => [
                    'Cálculo Diferencial', 'Fundamentos de Programación', 'Taller de Ética',
                    'Matemáticas Discretas', 'Taller de Administración', 'Fundamentos de Investigación'
                ]],
                ['semestre' => 2, 'materias' => [
                    'Cálculo Integral', 'Álgebra Lineal', 'Probabilidad y Estadística',
                    'Programación Orientada a Objetos', 'Contabilidad Financiera', 'Química'
                ]],
                ['semestre' => 3, 'materias' => [
                    'Cálculo Vectorial', 'Estructura de Datos', 'Cultura Empresarial',
                    'Investigación de Operaciones', 'Sistemas Operativos', 'Física General'
                ]],
                ['semestre' => 4, 'materias' => [
                    'Ecuaciones Diferenciales', 'Métodos Numéricos', 'Fundamentos de Bases de Datos',
                    'Taller de Sistemas Operativos', 'Principios Eléctricos y Aplicaciones Digitales'
                ]],
                ['semestre' => 5, 'materias' => [
                    'Desarrollo Sustentable', 'Fundamentos de Telecomunicaciones', 'Taller de Bases de Datos',
                    'Simulación', 'Fundamentos de Ingeniería de Software'
                ]],
                ['semestre' => 6, 'materias' => [
                    'Lenguajes y Autómatas I', 'Redes de Computadoras', 'Administración de Bases de Datos',
                    'Ingeniería de Software', 'Arquitectura de Computadoras'
                ]],
                ['semestre' => 7, 'materias' => [
                    'Lenguajes y Autómatas II', 'Comunicación y Enrutamiento de Redes', 'Taller de Investigación I',
                    'Gestión de Proyectos de Software', 'Sistemas Programables'
                ]],
                ['semestre' => 8, 'materias' => [
                    'Programación Lógica y Funcional', 'Administración de Redes', 'Taller de Investigación II',
                    'Programación Web', 'Programación Móvil con Lenguajes Nativos'
                ]],
                ['semestre' => 9, 'materias' => [
                    'Inteligencia Artificial', 'Programación Multiplataforma', 'Bases de Datos con ORM',
                    'Residencia Profesional', 'Servicio Social'
                ]]
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
                ['semestre' => 9, 'materias' => ['Medición y Mejoramiento de la Productividad', 'Manufactura Integrada por Computadora']]
            ]
        ];

        // Obtener los IDs de las retículas específicas
        $reticulaISC = Reticula::where('idreticula', 'RET06')->first();
        $reticulaIndustrial = Reticula::where('idreticula', 'RET07')->first();

        // Crear materias para Ingeniería en Sistemas Computacionales (ISC)
        if ($reticulaISC && $indiceISC < 45) { // Total de materias en ISC
            $semestreData = $materias['ISC'][intdiv($indiceISC, 5)];
            $semestre = $semestreData['semestre'];
            $materiaNombre = ucwords($semestreData['materias'][$indiceISC % 5]); // Capitaliza solo la primera letra de cada palabra
            $indiceISC++;

            return [
                'idmateria' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{8}'),
                'nombremateria' => substr($materiaNombre, 0, 200),
                'nivel' => $semestre <= 4 ? 1 : ($semestre <= 6 ? 2 : 3),
                'nombrecorto' => strtoupper(substr(preg_replace('/\s+/', '', $materiaNombre), 0, 8)), // Compacta y toma 8 caracteres
                'modalidad' => 'P',
                'semestre' => $semestre,
                'credito' => $this->faker->numberBetween(3, 6),
                'reticula_id' => $reticulaISC->id
            ];
        }

        // Crear materias para Ingeniería Industrial
        if ($reticulaIndustrial && $indiceIndustrial < 18) { // Total de materias en Industrial
            $semestreData = $materias['Industrial'][intdiv($indiceIndustrial, 2)];
            $semestre = $semestreData['semestre'];
            $materiaNombre = ucwords($semestreData['materias'][$indiceIndustrial % 2]); // Capitaliza solo la primera letra de cada palabra
            $indiceIndustrial++;

            return [
                'idmateria' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{8}'),
                'nombremateria' => substr($materiaNombre, 0, 200),
                'nivel' => $semestre <= 4 ? 1 : ($semestre <= 6 ? 2 : 3),
                'nombrecorto' => strtoupper(substr(preg_replace('/\s+/', '', $materiaNombre), 0, 8)), // Compacta y toma 8 caracteres
                'modalidad' => 'P',
                'semestre' => $semestre,
                'credito' => $this->faker->numberBetween(3, 6),
                'reticula_id' => $reticulaIndustrial->id
            ];
        }

        return [];
    }
}

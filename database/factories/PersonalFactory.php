<?php

namespace Database\Factories;

use App\Models\Depto;
use App\Models\Puesto;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Exception;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personal>
 */
class PersonalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     public function definition(): array
{
    $personas = [
        'Director' => ['Gustavo Emilio Rojo Velázquez'],
        'Subdirector académico' => [
            'Carlos Patiño Chávez', 
            'José Carlos Hernández Lozano', 
            'Tonatiuh Hernández Lozano'
        ],
        'Docente' => [
            'Roberto Espinoza Torres', 
            'Flor de María Rivera Sánchez', 
            'Antonio Chávez Soto', 
            'Pedro Cruz Vázquez', 
            'Juan Ramón Olague Sánchez', 
            'Hilda Patricia Beltrán Hernández', 
            'Aquiles González Ramos', 
            'Isidro García Sierra', 
            'Héctor Carlos Valadez Moyeda', 
            'David Sergio Castillón Domínguez'
        ]
    ];

    // Array para guardar las personas ya seleccionadas
    static $personasSeleccionadas = [];

    // Seleccionamos un rol aleatorio
    $rol = array_rand($personas);

    // Seleccionamos un nombre aleatorio, pero sin repetirlo
    $nombreCompleto = $this->faker->randomElement(array_diff($personas[$rol], $personasSeleccionadas));

    // Si todos los nombres de ese rol ya han sido seleccionados, volvemos a seleccionar otro rol
    if (!$nombreCompleto) {
        return $this->definition(); // Vuelve a llamar a la función si no hay personas disponibles
    }

    // Añadir la persona seleccionada al registro
    $personasSeleccionadas[] = $nombreCompleto;

    // Dividimos el nombre completo en partes
    $nombrePartes = explode(' ', $nombreCompleto);
    $nombres = $nombrePartes[0];
    $apellidoP = $nombrePartes[1];
    $apellidoM = $nombrePartes[2] ?? '';

    // Asignación de departamento y puesto
    $deptoNombre = '';
    $puestoNombre = $rol;

    switch ($rol) {
        case 'Director':
            $deptoNombre = 'Direccion';
            break;
        case 'Subdirector académico':
            $deptoNombre = 'Subdireccion';
            break;
        case 'Docente':
            $deptoNombre = 'ISC';
            break;
    }

    // Obtener IDs de departamento y puesto
    $depto = Depto::where('nombredepto', $deptoNombre)->first();
    $puesto = Puesto::where('nombre', $puestoNombre)->first();

    // Si no se encuentra el departamento o puesto, manejarlo adecuadamente
    if (!$depto || !$puesto) {
        return [];
    }

    return [
        'RFC' => $this->faker->regexify('[A-Z0-9]{10}'),
        'nombres' => $nombres,
        'apellidop' => $apellidoP,
        'apellidom' => $apellidoM,
        'licenciatura' => $this->faker->randomElement(['Ingeniería', 'Ciencias Computacionales', 'Matemáticas Aplicadas']),
        'lictit' => $this->faker->boolean ? 1 : 0,
        'especializacion' => $this->faker->optional()->randomElement(['Redes', 'IA', 'Desarrollo Web']),
        'esptit' => $this->faker->boolean ? 1 : 0,
        'maestria' => $this->faker->optional()->randomElement(['Administración', 'Educación', 'Ciencia de Datos']),
        'maetit' => $this->faker->boolean ? 1 : 0,
        'doctorado' => $this->faker->optional()->randomElement(['Educación', 'Computación']),
        'doctit' => $this->faker->boolean ? 1 : 0,
        'fechaingsep' => $this->faker->date(),
        'fechaingins' => $this->faker->date(),
        'depto_id' => $depto->id,
        'puesto_id' => $puesto->id,
    ];
}

}

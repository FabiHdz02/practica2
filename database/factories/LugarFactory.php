<?php

namespace Database\Factories;

use App\Models\Edificio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lugar>
 */
class LugarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Lista de nombres de lugar proporcionados
        $nombresLugar = [
            'IA', 'IB', 'ID', 'IE', '1D', '2D', '3D', '4D', '5D', '6D', '7D', '8D',
            '3H', '4H', '5H', '6H', '1K', '2K', '3K', '4K', '5K', '6K', '7K', '8K',
            '9K', '10K', '11K', '12K', '13K', '14K', 'LCEA', 'LCC', 'LCD', 'LCE', 'LCI',
            'LCR', 'LCV', 'AE1', 'AE2', 'LE1', 'LEAN', 'LED', 'LINS', 'LROB', 'LSP', 'LAUT',
            'LCIM', 'MF', 'LF'
        ];

        // Seleccionamos un nombre al azar de la lista
        $nombreLugar = $this->faker->randomElement($nombresLugar);

        // Lógica para asignar el edificio_id según el nombre del lugar
        if (in_array($nombreLugar, ['LCD', 'LCC', 'LCE', 'LCR', 'LCV', 'LCEA', 'LCI'])) {
            // Edificio Sistemas y Computación
            $edificioId = Edificio::where('nombreedificio', 'Sistemas y Computación')->first()->id;
        } elseif (preg_match('/\dD/', $nombreLugar)) {
            // Edificio D (del 1D al 8D)
            $edificioId = Edificio::where('nombreedificio', 'Edificio D')->first()->id;
        } elseif (preg_match('/\dH/', $nombreLugar)) {
            // Edificio H (del 3H al 6H)
            $edificioId = Edificio::where('nombreedificio', 'Edificio H')->first()->id;
        } elseif (preg_match('/\dK/', $nombreLugar)) {
            // Edificio K (del 1K al 14K)
            $edificioId = Edificio::where('nombreedificio', 'Edificio K')->first()->id;
        } else {
            // Si no hay coincidencia, asignar un edificio aleatorio
            $edificioId = Edificio::inRandomOrder()->first()->id;
        }

        // Retornar los datos para la creación del lugar
        return [
            'nombrelugar' => $nombreLugar, // Asignar nombre de lugar
            'nombrecorto' => substr($nombreLugar, 0, 5), // Asignar el nombre corto (los primeros 5 caracteres)
            'edificio_id' => $edificioId, // Asignar el edificio correspondiente
        ];
    }
}

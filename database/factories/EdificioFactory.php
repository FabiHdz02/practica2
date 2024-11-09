<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Edificio>
 */
class EdificioFactory extends Factory
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
    
        // Lista de edificios con nombres cortos específicos
        $edificios = [
            ['Edificio Administrativo', 'ADMIN'],
            ['Gestión Tecnológica y Vinculación', 'GTV'],
            ['Sala de Vinculación', 'VINC'],
            ['Servicios Escolares, División de Estudios Profesionales', 'SERV'],
            ['Centro de Cómputo', 'CCOMP'],
            ['Actividades Extraescolares', 'ACTEX'],
            ['Recursos Materiales y Servicios', 'RMAT'],
            ['Sala de Titulación', 'TITU'],
            ['Ciencias Básicas', 'CBAS'],
            ['Cubículos Ciencias Básicas', 'CUBI'],
            ['Edificio K', 'K'],
            ['Laboratorio de Electrónica', 'LABE'],
            ['Sistemas y Computación', 'SYS'],
            ['Laboratorio Cómputo Industrial', 'LCOMP'],
            ['Edificio de Ingeniería Industrial', 'INDU'],
            ['Centro de Idiomas', 'IDIOM'],
            ['Laboratorio de Química', 'LQUIM'],
            ['Edificio H', 'H'],
            ['Edificio D', 'D'],
            ['Sala de Cómputo Multifuncional Ciencias Básicas y Laboratorio de Física', 'SCML'],
        ];
    
        // Asegurarse de que el índice no se salga del rango de la lista
        if ($indice >= count($edificios)) {
            $indice = 0;
        }
    
        return [
            'nombreedificio' => $edificios[$indice][0],
            'nombrecorto' => $edificios[$indice][1],
        ];
    }     
}

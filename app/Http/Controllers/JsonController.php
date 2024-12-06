<?php

namespace App\Http\Controllers;

use App\Models\Depto;
use App\Models\Lugar;
use App\Models\Edificio;
use App\Models\Personal;
use Illuminate\Http\Request;
use App\Models\MateriaAbierta;

class JsonController extends Controller
{
    /* Todo de MateriaAbierta */

    /* Periodo */
    public function periodos()
    {
        $periodos = MateriaAbierta::with(['periodo:id,periodo'])
        ->get(['id', 'materia_id', 'periodo_id', 'carrera_id'])
        ->unique('periodo.periodo');
        return $periodos;
    }

    /* Carrera */
    public function carreras()
    {
        $carreras = MateriaAbierta::with(['carrera:id,nombrecarrera'])
        ->get(['id', 'materia_id', 'periodo_id', 'carrera_id'])
        ->unique('carrera.nombrecarrera');
        return $carreras;
    }

    /* Semestre */
    public function semestres()
    {
        $semestres = MateriaAbierta::with(['materia:id,semestre'])
        ->get(['id', 'materia_id', 'periodo_id', 'carrera_id'])
        ->unique('materia.semestre');
        return $semestres;
    }
    
    /* Materia */
    public function materias()
    {
        $materias = MateriaAbierta::with(['materia:id,nombremateria'])
        ->get(['id', 'materia_id', 'periodo_id', 'carrera_id'])
        ->unique('materia.nombremateria');
        return $materias;
    }

    /* Depto */
    public function deptos() {
        $deptos = Depto::get();
        return $deptos;
    }

    /* Personal */
    public function personal() {
        $personal = Personal::get();
        return $personal;
    }

    /* Edificio */
    public function edificios() {
        $edificios = Edificio::get();
        return $edificios;
    }

    /* Lugar */
    public function lugar() {
        $lugar = Lugar::get();
        return $lugar;
    }
}

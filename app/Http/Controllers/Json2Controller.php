<?php

namespace App\Http\Controllers;

use App\Models\Depto;
use App\Models\Grupo;
use App\Models\Lugar;
use App\Models\Alumno;
use App\Models\Carrera;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Edificio;
use App\Models\Personal;
use App\Models\GrupoHorario;

use Illuminate\Http\Request;
use App\Models\MateriaAbierta;
use Illuminate\Support\Facades\DB;

class Json2Controller extends Controller
{
    //
    public function periodos(){
        $periodos = Periodo::get();

        return  $periodos;
    }

    public function carreras(){
        $carreras = Carrera::get();

        return  $carreras;
    }

    public function semestres(){
        $semestres = Materia::get();
        $semestres = DB::table('materias')
        ->select('semestre')
        ->groupBy('semestre')
        ->orderBy('semestre')
        ->get();

        return  $semestres;
    }

    public function materias(){
        $materias = Materia::get();


        return  $materias;
    }

    public function departamentos(){
        $departamentos = Depto::get();

        return  $departamentos;
    }

    public function edificios(){
        $edificios = Edificio::get();

        return  $edificios;
    }

    public function lugares(){
        $edificios = Lugar::get();

        return  $edificios;
    }

    public function alumnos(){
        $alumnos = Alumno::get();

        return  $alumnos;
    }

    public function personals(){
        $personals = Personal::get();

        return  $personals;
    }

    public function materiasAbiertasPorSemestre($semestre)
    {
        try {
            $materiasAbiertas = MateriaAbierta::whereHas('materia', function ($query) use ($semestre) {
                $query->where('semestre', $semestre);
            })
            ->with('materia')
            ->get()
            ->map(function ($materiaAbierta) {
                return [
                    'id' => $materiaAbierta->id,
                    'nombremateria' => $materiaAbierta->materia->nombremateria,
                    'semestre' => $materiaAbierta->materia->semestre,
                ];
            });

            return response()->json($materiasAbiertas, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al cargar materias abiertas'], 500);
        }
    }


    public function insertarGrupo(Request $request)
{
    // Validar los datos recibidos
    $validatedData = $request->validate([
        'grupo' => 'required|string|max:5|unique:grupos,grupo',
        'descripcion' => 'required|string|max:200',
        'maxalumnos' => 'required|integer|min:1',
        'fecha' => 'required|date',
        'periodo_id' => 'required|exists:periodos,id',
        'materia_abierta_id' => 'required|exists:materia_abiertas,id',
        'personal_id' => 'nullable|exists:personals,id', // Personal puede ser nulo
    ]);

    try {
        // Crear el grupo en la base de datos
        $grupo = Grupo::create([
            'grupo' => $validatedData['grupo'],
            'descripcion' => $validatedData['descripcion'],
            'maxalumnos' => $validatedData['maxalumnos'],
            'fecha' => $validatedData['fecha'],
            'periodo_id' => $validatedData['periodo_id'],
            'materia_abierta_id' => $validatedData['materia_abierta_id'],
            'personal_id' => $validatedData['personal_id'], // Puede ser null
        ]);

        return response()->json([
            'message' => 'Grupo creado exitosamente.',
            'grupo' => $grupo
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Error al insertar el grupo.',
            'details' => $e->getMessage()
        ], 500);
    }
}



public function guardarHorario(Request $request)
{
    $validated = $request->validate([
        'grupo_id' => 'required|exists:grupos,id',
        'lugar_id' => 'required|exists:lugars,id',
        'dia' => 'required|string',
        'hora' => 'required|string',
    ]);

    // Validar si el mismo grupo ya tiene un horario en otro lugar para el mismo día y hora
    $conflictoGrupo = GrupoHorario::where('grupo_id', $validated['grupo_id'])
        ->where('dia', $validated['dia'])
        ->where('hora', $validated['hora'])
        ->where('lugar_id', '!=', $validated['lugar_id'])
        ->exists();

    if ($conflictoGrupo) {
        return response()->json([
            'message' => 'Ya has insertado un día con esa hora en otro lugar.',
        ], 400);
    }

    // Validar si el lugar está ocupado por otro grupo en el mismo día y hora
    $conflictoLugar = GrupoHorario::where('lugar_id', $validated['lugar_id'])
        ->where('dia', $validated['dia'])
        ->where('hora', $validated['hora'])
        ->where('grupo_id', '!=', $validated['grupo_id'])
        ->exists();

    if ($conflictoLugar) {
        return response()->json([
            'message' => 'Horario ocupado por otro grupo en este lugar.',
        ], 400);
    }

    // Insertar el horario si no hay conflictos
    $horario = GrupoHorario::create($validated);

    return response()->json([
        'message' => 'Horario guardado exitosamente.',
        'horario' => $horario,
    ], 200);
}

public function eliminarHorario(Request $request)
{
    $validated = $request->validate([
        'grupo_id' => 'required|exists:grupos,id',
        'lugar_id' => 'required|exists:lugars,id',
        'dia' => 'required|string',
        'hora' => 'required|string',
    ]);

    try {
        $deleted = GrupoHorario::where([
            'grupo_id' => $validated['grupo_id'],
            'lugar_id' => $validated['lugar_id'],
            'dia' => $validated['dia'],
            'hora' => $validated['hora'],
        ])->delete();

        if ($deleted) {
            return response()->json(['message' => 'Horario eliminado exitosamente.']);
        } else {
            return response()->json(['message' => 'Horario no encontrado.'], 404);
        }
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error al eliminar el horario.',
            'details' => $e->getMessage(),
        ], 500);
    }
}


public function obtenerHorarios(Request $request)
{
    $validated = $request->validate([
        'grupo_id' => 'required|exists:grupos,id',
        'lugar_id' => 'required|exists:lugars,id',
    ]);

    $horarios = GrupoHorario::where('grupo_id', $validated['grupo_id'])
        ->where('lugar_id', $validated['lugar_id'])
        ->get(['dia', 'hora']);

    return response()->json($horarios);
}


public function obtenerGrupo($grupo)
{
    $grupo = Grupo::with('horarios') // Relación de horarios
        ->where('grupo', $grupo)
        ->first();

    if (!$grupo) {
        return response()->json(['error' => 'Grupo no encontrado'], 404);
    }

    return response()->json($grupo);
}


public function obtenerMateriasAbiertasPorCarreraSemestre($carreraId, $semestreId)
{
    try {
        // Realiza la consulta con relaciones
        $materias = MateriaAbierta::join('materias', 'materia_abiertas.materia_id', '=', 'materias.id')
            ->where('materia_abiertas.carrera_id', $carreraId)
            ->where('materias.semestre', $semestreId)
            ->select('materia_abiertas.id as id', 'materias.nombremateria', 'materias.semestre')
            ->get();

        // Si no hay resultados, responde con un mensaje vacío
        if ($materias->isEmpty()) {
            return response()->json(['message' => 'No hay materias abiertas para esta carrera y semestre.', 'data' => []], 200);
        }

        return response()->json(['message' => 'Materias abiertas encontradas.', 'data' => $materias], 200);
    } catch (\Exception $e) {
        // Maneja errores
        return response()->json(['message' => 'Error al obtener las materias abiertas.', 'error' => $e->getMessage()], 500);
    }
}



}

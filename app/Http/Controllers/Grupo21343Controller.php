<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Models\Grupo21343;
use App\Models\MateriaAbierta;
use App\Models\GrupoHorario21343;
use App\Models\Personal;
use App\Models\Lugar; // Importar el modelo Lugar
use Illuminate\Http\Request;

class Grupo21343Controller extends Controller
{
    public function index21343()
    {
        $grupos = Grupo21343::with(['periodo', 'materiaAbierta.materia', 'materiaAbierta.personal'])->paginate(8);

        return view('grupos21343.index21343', compact('grupos'));
    }

    public function create()
    {
        $periodos = Periodo::all();
        $materiasa = MateriaAbierta::with('materia')->get();
        $personales = Personal::all();
        $lugares = Lugar::all(); // Obtener todos los lugares

        // Enviar grupoHorarios vacío
        return view('grupos21343.frm', [
            'accion' => 'C',
            'grupo' => new Grupo21343(),
            'periodos' => $periodos,
            'materiasa' => $materiasa,
            'personales' => $personales,
            'lugares' => $lugares, // Pasar lugares a la vista
            'grupoHorarios' => collect(), // Enviar un array vacío
            'precarga' => [
                'dia' => 'lunes',
                'hora' => '07-08',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'grupo' => 'required|string|max:5|unique:grupo21343s',
            'descripcion' => 'required|string|max:200',
            'maxalumnos' => 'required|integer',
            'fecha' => 'required|date',
            'periodo_id' => 'required|integer',
            'materia_abierta_id' => 'required|integer',
            'personal_id' => 'nullable|integer',
        ]);

        $grupos = Grupo21343::create($request->all());

        // Redirigir a editar del grupo creado
        return redirect()->route('grupos21343.edit', $grupos->id);
    }

    public function edit(Grupo21343 $grupo21343)
    {
        $periodos = Periodo::all();
        $materiasa = MateriaAbierta::with('materia')->get();
        $personales = Personal::all();
        $lugares = Lugar::all(); // Obtener todos los lugares

        // Precargar datos para GRUPOSHORARIOS
        $grupoHorarios = GrupoHorario21343::where('grupo_id', $grupo21343->id)->get();

        return view('grupos21343.frm', [
            'accion' => 'E',
            'grupo' => $grupo21343,
            'periodos' => $periodos,
            'materiasa' => $materiasa,
            'personales' => $personales,
            'lugares' => $lugares, // Pasar lugares a la vista
            'grupoHorarios' => $grupoHorarios, // Pasar datos de horarios
            'precarga' => [
                'dia' => 'lunes',
                'hora' => '07-08',
            ],
        ]);
    }

    public function update(Request $request, Grupo21343 $grupo21343)
    {
        $request->validate([
            'grupo' => 'required|string|max:5|unique:grupo21343s,grupo,' . $grupo21343->id,
            'descripcion' => 'required|string|max:200',
            'maxalumnos' => 'required|integer',
            'fecha' => 'required|date',
            'periodo_id' => 'required|integer',
            'materia_abierta_id' => 'required|integer',
            'personal_id' => 'nullable|integer',
        ]);

        $grupo21343->update($request->all());

        // Redirigir a editar del grupo actualizado
        return redirect()->route('grupos21343.edit', $grupo21343->id);
    }

    public function destroy(Grupo21343 $grupo21343)
    {
        $grupo21343->delete();
        return redirect()->route('grupos21343.index21343')->with('mensaje', 'Grupo eliminado correctamente');
    }
}

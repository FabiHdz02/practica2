<?php

namespace App\Http\Controllers;

use App\Models\HorarioAlumno;
use App\Models\Alumno;
use App\Models\GrupoHorario;
use Illuminate\Http\Request;

class HorarioAlumnoController extends Controller
{
    public function index()
    {
        $horarioAlumnos = HorarioAlumno::with(['alumno', 'grupoHorario.grupo'])->paginate(10);
        $grupoHorarios = GrupoHorario::with(['grupo.personal'])->paginate(10);
        return view('horario_alumnos.index', compact('horarioAlumnos', "grupoHorarios"));
    }    

    public function create()
    {
        $alumnos = Alumno::all();
    
        // Carga relaciones hasta llegar a la materia
        $grupoHorarios = GrupoHorario::with(['grupo.materiaAbierta.materia'])->get();
    
        return view('horario_alumnos.frm', compact('alumnos', 'grupoHorarios'))->with('accion', 'C');
    }

    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'grupo_horario_id' => 'required|exists:grupo_horarios,id',
        ]);

        HorarioAlumno::create($request->all());

        return redirect()->route('horario_alumnos.index')->with('mensaje', 'Registro creado con éxito.');
    }

    public function edit(HorarioAlumno $horarioAlumno)
    {
        $alumnos = Alumno::all();
        $grupoHorarios = GrupoHorario::all();
        return view('horario_alumnos.frm', compact('horarioAlumno', 'alumnos', 'grupoHorarios'))->with('accion', 'E');
    }

    public function update(Request $request, HorarioAlumno $horarioAlumno)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'grupo_horario_id' => 'required|exists:grupo_horarios,id',
        ]);

        $horarioAlumno->update($request->all());

        return redirect()->route('horario_alumnos.index')->with('mensaje', 'Registro actualizado con éxito.');
    }

    public function destroy(HorarioAlumno $horarioAlumno)
    {
        $horarioAlumno->delete();

        return redirect()->route('horario_alumnos.index')->with('mensaje', 'Registro eliminado con éxito.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Models\Grupo;
use App\Models\MateriaAbierta;
use App\Models\GrupoHorario;
use App\Models\Personal;
use App\Models\Lugar; // Importar el modelo Lugar
use App\Models\Depto; // Importar el modelo Departamento
use App\Models\Edificio;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        $grupos = Grupo::with(['periodo', 'materiaAbierta.materia', 'materiaAbierta.personal'])->paginate(8);

        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        $periodos = Periodo::all(); // Todos los periodos
        $materiasa = MateriaAbierta::with('materia')->get(); // Materias abiertas con relación a materias
        $personales = Personal::all(); // Todo el personal
        $lugares = Lugar::all(); // Todos los lugares
        $deptos = Depto::all(); // Todos los departamentos
        $edificios = Edificio::all();
        $semestres = MateriaAbierta::with('materia')->get()->unique('materia.semestre'); // Semestres únicos basados en materias

        // Enviar grupoHorarios vacío
        return view('grupos.frm', [
            'accion' => 'C',
            'grupo' => new Grupo(),
            'periodos' => $periodos,
            'materiasa' => $materiasa,
            'personales' => $personales,
            'edificios' => $edificios,
            'lugares' => $lugares, // Lugares
            'deptos' => $deptos, // Departamentos
            'semestres' => $semestres, // Semestres únicos
            'grupoHorarios' => collect(), // Array vacío para horarios
            'precarga' => [
                'dia' => 'lunes',
                'hora' => '07-08',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'grupo' => 'required|string|max:5|unique:grupos',
            'descripcion' => 'required|string|max:200',
            'maxalumnos' => 'required|integer',
            'fecha' => 'required|date',
            'periodo_id' => 'required|integer',
            'carrera_id' => 'required|integer',
            'semestre' => 'required|integer',
            'materia_abierta_id' => 'required|integer',
            'departamento' => 'required|integer',
            'personal_id' => 'nullable|integer',
        ]);
    
        try {
            $grupo = Grupo::create($request->all());
    
            return redirect()->route('grupos.edit', $grupo->id)
                             ->with('mensaje', 'Grupo creado exitosamente')
                             ->withInput(); // Mantener los datos del formulario
        } catch (\Exception $e) {
            return redirect()->back()
                             ->withErrors(['error' => 'Error al guardar el grupo: ' . $e->getMessage()])
                             ->withInput(); // Retornar datos en caso de error
        }
    }    

    public function edit(Grupo $grupo)
    {
        $periodos = Periodo::all(); // Todos los periodos
        $materiasa = MateriaAbierta::with('materia')->get(); // Materias abiertas con relación a materias
        $personales = Personal::all(); // Todo el personal
        $lugares = Lugar::all(); // Todos los lugares
        $deptos = Depto::all(); // Todos los departamentos
        $semestres = MateriaAbierta::with('materia')->get()->unique('materia.semestre'); // Semestres únicos basados en materias
        $edificios = Edificio::all();
        // Precargar datos para GRUPOSHORARIOS
        $grupoHorarios = GrupoHorario::where('grupo_id', $grupo->id)->get();

        return view('grupos.frm', [
            'accion' => 'E',
            'grupo' => $grupo,
            'periodos' => $periodos,
            'materiasa' => $materiasa,
            'personales' => $personales,
            'edificios' => $edificios,
            'lugares' => $lugares, // Lugares
            'deptos' => $deptos, // Departamentos
            'semestres' => $semestres, // Semestres únicos
            'grupoHorarios' => $grupoHorarios, // Pasar datos de horarios
            'precarga' => [
                'dia' => 'lunes',
                'hora' => '07-08',
            ],
        ]);
    }

    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            'grupo' => 'required|string|max:5|unique:grupos,grupo,' . $grupo->id,
            'descripcion' => 'required|string|max:200',
            'maxalumnos' => 'required|integer',
            'fecha' => 'required|date',
            'periodo_id' => 'required|integer',
            'materia_abierta_id' => 'required|integer',
            'personal_id' => 'nullable|integer',
        ]);

        $grupo->update($request->all());

        // Redirigir a editar del grupo actualizado
        return redirect()->route('grupos.edit', $grupo->id);
    }

    public function destroy(Grupo $grupo)
    {
        // Eliminar horarios relacionados
        $grupo->horarios()->delete();
    
        // Eliminar el grupo
        $grupo->delete();
    
        return redirect()->route('grupos.index')->with('mensaje', 'Grupo y sus horarios eliminados correctamente');
    }
    
}

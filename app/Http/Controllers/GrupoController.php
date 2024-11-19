<?php

namespace App\Http\Controllers;

use App\Models\Depto;
use App\Models\Grupo;
use App\Models\Lugar;
use App\Models\Carrera;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Edificio;
use App\Models\Personal;
use App\Models\GrupoHorario;
use Illuminate\Http\Request;
use App\Models\MateriaAbierta;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $grupos = Grupo::paginate(8);
        $periodos = Periodo::all();
        $materiasa = MateriaAbierta::all();
        $personales = Personal::all();
        $carreras = Carrera::with('depto')->get();
        $deptos = Depto::with(['carrera', 'personal'])->get();
        $depto = Depto::all();
        $edificios = Edificio::with('lugares')->get();
        $lugares = Lugar::all();
        
        // Get all existing group names for JavaScript validation
        $existingGroups = Grupo::pluck('grupo')->toArray();
        
        return view("grupos.index", compact("grupos", "periodos", "materiasa", 
        "personales", "carreras", "edificios", "lugares", "deptos", "existingGroups", "depto"));
    }
    
    public function create()
    {
        return view('grupos.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'grupo' => 'required|string|max:5',
            'descripcion' => 'required|string|max:200',
            'maxalumnos' => 'required|integer',
            'fecha' => 'required|date',
            'periodo_id' => 'required|exists:periodos,id',
            'materia_abierta_id' => 'required|exists:materia_abiertas,id',
            'personal_id' => 'nullable|exists:personals,id',
        ]);
    
        try {
            $grupo = Grupo::create($validatedData);
            
            // Obtener la información completa de la materia abierta
            $materiaAbierta = MateriaAbierta::with(['carrera', 'materia'])->find($request->materia_abierta_id);
            
            // Guardar en la sesión todos los datos necesarios
            session()->flash('form_data', [
                'grupo' => $request->grupo,
                'descripcion' => $request->descripcion,
                'maxalumnos' => $request->maxalumnos,
                'fecha' => $request->fecha,
                'periodo_id' => $request->periodo_id,
                'carrera_id' => $materiaAbierta->carrera->id,
                'semestre' => $materiaAbierta->materia->semestre,
                'materia_abierta_id' => $request->materia_abierta_id,
                'personal_id' => $request->personal_id
            ]);
            
            return redirect()->route('grupos.index')
                ->with('success', 'Grupo registrado con éxito')
                ->with('show_form', true);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors('Error al guardar el grupo: ' . $e->getMessage());
        }
    }

    public function edit($grupo)
    {
        // Buscar el grupo por su nombre
        $grupoData = Grupo::where('grupo', $grupo)->firstOrFail();

        // Recuperar los horarios asociados a este grupo
        $grupoHorarios = $grupoData->grupoHorarios()->with(['lugar', 'edificio'])->get();

        // Recuperar datos necesarios para el formulario
        $periodos = Periodo::all();
        $materiasa = MateriaAbierta::all();
        $personales = Personal::all();
        $carreras = Carrera::with('depto')->get();
        $deptos = Depto::with(['carrera', 'personal'])->get();
        $edificios = Edificio::with('lugares')->get();
        $lugares = Lugar::all();

        return view('grupos.edit', compact(
            'grupoData',
            'grupoHorarios',
            'periodos',
            'materiasa',
            'personales',
            'carreras',
            'edificios',
            'lugares',
            'deptos'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'grupo' => 'required|string|max:5|unique:grupos,grupo,' . $id,
            'descripcion' => 'required|string|max:200',
            'maxalumnos' => 'required|integer|min:1',
            'fecha' => 'required|date',
            'periodo_id' => 'required|exists:periodos,id',
            'materia_abierta_id' => 'required|exists:materia_abiertas,id',
            'personal_id' => 'nullable|exists:personals,id',
            'horarios.*.dia' => 'nullable|integer|min:0|max:4',
            'horarios.*.hora' => 'nullable|date_format:H:i',
            'horarios.*.lugar_id' => 'nullable|exists:lugars,id',
        ]);
    
        $grupo = Grupo::findOrFail($id);
    
        $grupo->update($request->only([
            'grupo',
            'descripcion',
            'maxalumnos',
            'fecha',
            'periodo_id',
            'materia_abierta_id',
            'personal_id',
        ]));
    
        if ($request->has('horarios')) {
            foreach ($request->horarios as $horarioId => $horarioData) {
                $grupoHorario = GrupoHorario::findOrFail($horarioId);
    
                if ($grupoHorario->grupo_id != $grupo->id) {
                    return redirect()->back()->withErrors(['error' => 'Horario no válido para este grupo.']);
                }
    
                $grupoHorario->update($horarioData);
            }
        }
    
        return redirect()->route('grupos.index')->with('success', 'Grupo y horarios actualizados correctamente.');
    }    
}

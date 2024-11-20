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
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
        // Buscar el grupo por su nombre, incluyendo los horarios relacionados
        $grupoData = Grupo::with([
            'grupoHorarios' => function ($query) {
                $query->with(['lugar', 'lugar.edificio']);
            }
        ])->where('grupo', $grupo)->firstOrFail();
    
        // Obtener los horarios del grupo
        $grupoHorarios = GrupoHorario::where('grupo_id', $grupoData->id)->get();
    
        // Otros datos necesarios para el formulario
        $periodos = Periodo::all();
        $materiasa = MateriaAbierta::all();
        $personales = Personal::all();
        $carreras = Carrera::with('depto')->get();
        $deptos = Depto::with(['carrera', 'personal'])->get();
        $edificios = Edificio::with('lugares')->get();
        $lugares = Lugar::all();
    
        // Recuperar todos los grupos para el selector
        $grupos = Grupo::all();
    
        // Verificar que los datos de horarios lleguen correctamente (opcional para depuración)
        // dd($grupoHorarios->toArray());
    
        // Retornar a la vista con los datos cargados
        return view('grupos.edit', compact(
            'grupoData',
            'grupoHorarios',
            'periodos',
            'materiasa',
            'personales',
            'carreras',
            'edificios',
            'lugares',
            'deptos',
            'grupos'
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
            'horarios' => 'array',
            'edificio_id' => 'required|exists:edificios,id',
            'lugar_id' => 'required|exists:lugars,id'
        ]);
    
        try {
            DB::beginTransaction();
            
            // Actualizar grupo
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
    
            // Eliminar horarios existentes
            GrupoHorario::where('grupo_id', $grupo->id)->delete();
    
            // Crear nuevos horarios
            if ($request->has('horarios')) {
                foreach ($request->horarios as $horario) {
                    // El formato esperado es "dia-hora", ejemplo: "1-07:00"
                    list($dia, $hora) = explode('-', $horario);
                    
                    GrupoHorario::create([
                        'grupo_id' => $grupo->id,
                        'dia' => $dia,
                        'hora' => $hora,
                        'lugar_id' => $request->lugar_id,
                    ]);
                }
            }
    
            DB::commit();
            return redirect()->route('grupos.index')->with('success', 'Grupo y horarios actualizados correctamente.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Error al actualizar: ' . $e->getMessage()]);
        }
    }

}

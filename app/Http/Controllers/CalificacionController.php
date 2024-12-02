<?php
 
namespace App\Http\Controllers;
 
use App\Models\Grupo;
use App\Models\Personal;
use App\Models\Calificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class CalificacionController extends Controller
{
    protected $validationRules;
 
    public function __construct()
    {
        $this->validationRules = [
            'calificacion' => ['required', 'numeric', 'min:0', 'max:10'],
            'alumno_id' => ['required', 'exists:alumnos,id'],
            'horario_alumno_id' => ['required', 'exists:horario_alumnos,id'],
            'horario_grupo_id' => ['required', 'exists:horario_grupos,id'],
        ];
    }
 
    public function index(Request $request)
{
    $user = Auth::user();

    // Buscar el docente asociado al usuario autenticado
    $docenteAuth = Personal::where('nombres', $user->name)->first();

    if (!$docenteAuth) {
        return view('calificaciones.index')->with('error', 'No se encontró un docente asociado a este usuario.');
    }

    // Cargar grupos con relaciones necesarias
    $grupos = Grupo::with(['horarios.alumnos.alumno', 'horarios.alumnos.calificacion', 'materiaAbierta.materia'])
        ->where('personal_id', $docenteAuth->id)
        ->get();

    return view('calificaciones.index', compact('grupos', 'docenteAuth'));
}



public function store(Request $request)
{
    $docenteAuth = Personal::where('nombres', Auth::user()->name)->first();

    if (!$docenteAuth) {
        return redirect()->back()->withErrors(['error' => 'No se encontró un docente asociado a este usuario.']);
    }

    $request->validate([
        'calificaciones.*.calificacion' => 'required|numeric|min:0|max:100',
        'calificaciones.*.horario_alumno_id' => 'required|exists:horario_alumnos,id',
        'calificaciones.*.horario_grupo_id' => 'required|exists:grupo_horarios,id',
    ]);

    foreach ($request->calificaciones as $alumnoId => $data) {
        Calificacion::updateOrCreate(
            [
                'alumno_id' => $alumnoId,
                'horario_alumno_id' => $data['horario_alumno_id'],
                'horario_grupo_id' => $data['horario_grupo_id'],
            ],
            [
                'calificacion' => $data['calificacion'],
            ]
        );
    }

    return redirect()->back()->with('success', 'Calificaciones guardadas correctamente.');
}
}
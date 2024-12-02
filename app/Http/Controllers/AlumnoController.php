<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Carrera;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    protected $val;

    public function __construct()
    {
        $this->val = [
            'noctrl' => ['required', 'string', 'max:8'],
            'nombre' => ['required', 'string', 'max:50'],
            'apellidop' => ['required', 'string', 'max:50'],
            'apellidom' => ['nullable', 'string', 'max:50'],
            'semestre' => ['nullable', 'integer'],
            'sexo' => ['required', 'string', 'max:1'],
            'carrera_id' => ['required', 'exists:carreras,id'],
        ];
    }

    public function index()
    {
        $alumnos = Alumno::with('carrera')->paginate(8);
        return view("alumnos.index", compact("alumnos"));
    }

    public function create()
    {
        $alumno = new Alumno;
        $carreras = Carrera::all();
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";
        return view("alumnos.frm", compact("alumno", "carreras", "accion", "txtbtn", "des"));
    }

    public function store(Request $request)
    {
        $val = $request->validate($this->val);
        Alumno::create($val);
        return redirect()->route("alumnos.index")->with("mensaje", "Alumno registrado correctamente.");
    }

    public function show(Alumno $alumno)
    {
        $carreras = Carrera::all();
        $txtbtn = "";
        $accion = "D";
        $des = "disabled";
        return view("alumnos.frm", compact("alumno", "carreras", "accion", "txtbtn", "des"));
    }

    public function edit(Alumno $alumno)
    {
        $carreras = Carrera::all();
        $accion = "E";
        $txtbtn = "Actualizar";
        $des = "";
        return view("alumnos.frm", compact("alumno", "carreras", "accion", "txtbtn", "des"));
    }

    public function update(Request $request, Alumno $alumno)
    {
        // Validar los datos de entrada
        $val = $request->validate($this->val);
    
        // Actualizar el registro del alumno
        $alumno->update($val);
    
        // Obtener la URL de referencia desde donde se hizo la solicitud
        $referer = $request->headers->get('referer');
    
        // Verificar si la URL contiene 'horario_alumnos'
        if (str_contains($referer, 'horario_alumnos')) {
            return redirect()->route('horario_alumnos.index')->with('mensaje', 'Alumno actualizado correctamente.');
        }
    
        // Redirigir por defecto a la lista de alumnos
        return redirect()->route('alumnos.index')->with('mensaje', 'Alumno actualizado correctamente.');
    }

    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return redirect()->route("alumnos.index");
    }
}

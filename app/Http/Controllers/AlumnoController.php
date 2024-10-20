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
            'noctrl' => ['required', 'string', 'max:8', 'unique:alumnos,noctrl'],
            'nombre' => ['required', 'string', 'max:50'],
            'apellidop' => ['required', 'string', 'max:50'],
            'apellidom' => ['nullable', 'string', 'max:50'],
            'sexo' => ['required', 'string', 'max:1'],
            'carrera_id' => ['required', 'exists:carreras,id'],
        ];
    }

    public function index()
    {
        $alumnos = Alumno::paginate(8);
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
        $alumno->update($request->all());
        return redirect()->route("alumnos.index")->with("mensaje", "Alumno actualizado correctamente.");
    }
    

    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return redirect()->route("alumnos.index");
    }
}

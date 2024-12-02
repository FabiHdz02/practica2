<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Reticula;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public $val;

    public function __construct()
    {
        $this->val = [
            'idmateria' => ['required', 'max:10', 'unique:materias,idmateria'],
            'nombremateria' => ['required', 'min:3', 'max:200', 'unique:materias,nombremateria'],
            'nivel' => ['required', 'size:1'],
            'nombrecorto' => ['required', 'max:10', 'unique:materias,nombrecorto'],
            'modalidad' => ['required', 'size:1'],
            'semestre' => ['required', 'integer', 'between:1,9'],
            'credito' => ['required', 'integer', 'between:3,6'], // Agregado
            'reticula_id' => ['required', 'exists:reticulas,id']
        ];
    }

    public function index()
    {
        $materias = Materia::paginate(8); 
        return view("materias.index", compact("materias")); 
    }

    public function create()
    {
        $reticulas = Reticula::all();
        $materia = new Materia;
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";
        return view("materias.frm", compact("materia", "reticulas", "accion", "txtbtn", "des"));
    }

    public function store(Request $request)
    {
        $val = $request->validate($this->val);
        Materia::create($val);
        return redirect()->route("materias.index")->with("mensaje", "Materia registrada correctamente.");
    }

    public function show(Materia $materia)
    {
        $reticulas = Reticula::all();
        $accion = "D";
        $txtbtn = "";
        $des = "disabled";
        return view("materias.frm", compact("materia", "reticulas", "accion", "txtbtn", "des"));
    }

    public function edit(Materia $materia)
    {
        $reticulas = Reticula::all();
        $accion = "E";
        $txtbtn = "Actualizar";
        $des = "";
        return view("materias.frm", compact('materia', "reticulas", "accion", "txtbtn", "des"));
    }

    public function update(Request $request, Materia $materia)
    {
        $val = $request->validate([
            'idmateria' => 'required',
            'nombremateria' => 'required',
            'nivel' => 'required',
            'nombrecorto' => 'required',
            'modalidad' => 'required',
            'semestre' => ['required', 'integer', 'between:1,9'],
            'credito' => ['required', 'integer', 'between:3,6'], // Agregado

        ]);
        $materia->update($val);
        return redirect()->route("materias.index")->with("mensaje", "Materia actualizada correctamente.");
    }


    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route("materias.index")->with("mensaje", "Materia eliminada correctamente.");
    }
}

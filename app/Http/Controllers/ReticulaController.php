<?php

namespace App\Http\Controllers;

use App\Models\Reticula;
use App\Models\Carrera;
use Illuminate\Http\Request;

class ReticulaController extends Controller
{
    public $val;

    public function __construct()
    {
        $this->val = [
            'idreticula' => ['required', 'max:15', 'unique:reticulas,idreticula'],
            'descripcion' => ['required', 'max:200', 'unique:reticulas,descripcion'],
            'fechavigor' => ['required', 'date', 'unique:reticulas,fechavigor'],
            'carrera_id' => ['required', 'exists:carreras,id']
        ];
    }

    public function index()
    {
        $reticulas = Reticula::paginate(8);
        return view("reticulas.index", compact("reticulas"));
    }

    public function create()
    {
        $carreras = Carrera::all();
        $reticula = new Reticula;
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";
        return view("reticulas.frm", compact("reticula", "carreras", "accion", "txtbtn", "des"));
    }

    public function store(Request $request)
    {
        $val = $request->validate($this->val);
        Reticula::create($val);
        return redirect()->route("reticulas.index")->with("mensaje", "Retícula registrada correctamente.");
    }

    public function show(Reticula $reticula)
    {
        $carreras = Carrera::all();
        $accion = "D";
        $txtbtn = "";
        $des = "disabled";
        return view("reticulas.frm", compact("reticula", "carreras", "accion", "txtbtn", "des"));
    }

    public function edit(Reticula $reticula)
    {
        $carreras = Carrera::all();
        $accion = "E";
        $txtbtn = "Actualizar";
        $des = "";
        return view("reticulas.frm", compact("reticula", "carreras", "accion", "txtbtn", "des"));
    }

    public function update(Request $request, Reticula $reticula)
    {
        $this->val['idreticula'][2] = 'unique:reticulas,idreticula,' . $reticula->id;
        $this->val['descripcion'][2] = 'unique:reticulas,descripcion,' . $reticula->id;
        $this->val['fechavigor'][2] = 'unique:reticulas,fechavigor,' . $reticula->id;
        $val = $request->validate($this->val);
        $reticula->update($val);
        return redirect()->route("reticulas.index")->with("mensaje", "Retícula actualizada correctamente.");
    }

    public function destroy(Reticula $reticula)
    {
        $reticula->delete();
        return redirect()->route("reticulas.index")->with("mensaje", "Retícula eliminada correctamente.");
    }
}

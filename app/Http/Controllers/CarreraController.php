<?php

namespace App\Http\Controllers;

use App\Models\Depto;
use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public $val;

    public function __construct()
    {
        $this->val = [
            'idcarrera' => ['required', 'max:15'],
            'nombrecarrera' => ['required', 'min:3', 'max:200'],
            'nombremediano' => ['required', 'max:50'],
            'nombrecorto' => ['required', 'max:5'],
            'depto_id' => ['required', 'exists:deptos,id']
        ];
    }

    public function index()
    {
        $carreras = Carrera::paginate(8); 
        return view("carreras.index", compact("carreras")); 
    }

    public function create()
    {
        $deptos = Depto::all();
        $carrera = new Carrera;
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";
        return view("carreras.frm", compact("carrera", "deptos", "accion", "txtbtn", "des"));
    }

    public function store(Request $request)
    {
        $val = $request->validate($this->val);
        Carrera::create($val);
        return redirect()->route("carreras.index")->with("mensaje", "Carrera registrada correctamente.");
    }

    public function show(Carrera $carrera)
    {
        $deptos = Depto::all();
        $accion = "D";
        $txtbtn = "";
        $des = "disabled";
        return view("carreras.frm", compact("carrera", "deptos", "accion", "txtbtn", "des"));
    }

    public function edit(Carrera $carrera)
    {
        $deptos = Depto::all();
        $accion = "E";
        $txtbtn = "Actualizar";
        $des = "";
        return view("carreras.frm", compact('carrera', "deptos", "accion", "txtbtn", "des"));
    }

    public function update(Request $request, Carrera $carrera)
    {
        $val = $request->validate($this->val);
        $carrera->update($val);
        return redirect()->route("carreras.index")->with("mensaje", "Carrera actualizada correctamente.");
    }

    public function destroy(Carrera $carrera)
    {
        $carrera->delete();
        return redirect()->route("carreras.index")->with("mensaje", "Carrera eliminada correctamente.");
    }
}

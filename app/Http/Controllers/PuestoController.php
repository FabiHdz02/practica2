<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    protected $val;

    public function __construct()
    {
        $this->val = [
            'idpuesto' => ['required', 'string', 'max:10', 'unique:puestos,idpuesto'],
            'nombre' => ['required', 'string', 'max:200'],
            'tipo' => ['required', 'string', 'max:200'],
        ];
    }

    public function index()
    {
        $puestos = Puesto::paginate(8);
        return view("puestos.index", compact("puestos"));
    }

    public function create()
    {
        $puesto = new Puesto;
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";
        return view("puestos.frm", compact("puesto", "accion", "txtbtn", "des"));
    }

    public function store(Request $request)
    {
        $val = $request->validate($this->val);
        Puesto::create($val);
        return redirect()->route("puestos.index")->with("mensaje", "Puesto registrado correctamente.");
    }

    public function show(Puesto $puesto)
    {
        $accion = "D";
        $txtbtn = "Confirmar Eliminación";
        $des = "disabled";
        return view("puestos.frm", compact("puesto", "accion", "txtbtn", "des"));
    }

    public function edit(Puesto $puesto)
    {
        $accion = "E";
        $txtbtn = "Actualizar";
        $des = "";
        return view("puestos.frm", compact("puesto", "accion", "txtbtn", "des"));
    }

    public function update(Request $request, Puesto $puesto)
    {
        $puesto->fill($request->all()); 
        $puesto->save(); 
        return redirect()->route("puestos.index")->with("mensaje", "Puesto actualizado correctamente.");
    }
    

    public function destroy(Puesto $puesto)
    {
        $puesto->delete();
        return redirect()->route("puestos.index")->with("mensaje", "Puesto eliminado correctamente.");
    }
}

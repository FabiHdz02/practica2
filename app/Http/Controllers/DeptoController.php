<?php

namespace App\Http\Controllers;

use App\Models\Depto;
use Illuminate\Http\Request;

class DeptoController extends Controller
{
    public function index()
    {
        $deptos = Depto::paginate(8);
        return view("deptos.index", compact("deptos"));
    }

    public function create()
    {
        $depto = new Depto;
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";
        return view("deptos.frm", compact("depto", "accion", "txtbtn", "des"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombredepto' => 'required|string|max:255',
            'nombremediano' => 'required|string|max:255',
            'nombrecorto' => 'required|string|max:50',
        ]);
    
        Depto::create($request->all());
        return redirect()->route("deptos.index")->with("mensaje", "Depto registrado correctamente.");
    }
    
    public function show(Depto $depto)
    {
        $accion = "D";
        $txtbtn = "";
        $des = "disabled";
        return view("deptos.frm", compact("depto", "accion", "txtbtn", "des"));
    }

    public function edit(Depto $depto)
    {
        $accion = "E";
        $txtbtn = "Actualizar";
        $des = "";
        return view("deptos.frm", compact("depto", "accion", "txtbtn", "des"));
    }

    public function update(Request $request, Depto $depto)
    {
        $request->validate([
            'nombredepto' => 'required|string|max:255',
            'nombremediano' => 'required|string|max:255',
            'nombrecorto' => 'required|string|max:50',
        ]);
    
        $depto->update($request->all());
        return redirect()->route("deptos.index")->with("mensaje", "Depto actualizado correctamente.");
    }

    public function destroy(Depto $depto)
    {
        $depto->delete();
        return redirect()->route("deptos.index")->with("mensaje", "Depto eliminado correctamente.");
    }
}

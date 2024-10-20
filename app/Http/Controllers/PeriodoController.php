<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    public function index()
    {
        $periodos = Periodo::paginate(8);
        return view("periodos.index", compact("periodos"));
    }

    public function create()
    {
        $periodo = new Periodo;
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";
        return view("periodos.frm", compact("periodo", "accion", "txtbtn", "des"));
    }

    public function store(Request $request)
    {
        // Eliminadas las reglas de validación
        Periodo::create($request->all());
        return redirect()->route("periodos.index")->with("mensaje", "Periodo registrado correctamente.");
    }
    
    public function show(Periodo $periodo)
    {
        $accion = "D";
        $txtbtn = "";
        $des = "disabled";
        return view("periodos.frm", compact("periodo", "accion", "txtbtn", "des"));
    }

    public function edit(Periodo $periodo)
    {
        $accion = "E";
        $txtbtn = "Actualizar";
        $des = "";
        return view("periodos.frm", compact("periodo", "accion", "txtbtn", "des"));
    }

    public function update(Request $request, Periodo $periodo)
    {
        $periodo->update($request->all());
        return redirect()->route("periodos.index")->with("mensaje", "Periodo actualizado correctamente.");
    }

    public function destroy(Periodo $periodo)
    {
        $periodo->delete();
        return redirect()->route("periodos.index")->with("mensaje", "Periodo eliminado correctamente.");
    }
}

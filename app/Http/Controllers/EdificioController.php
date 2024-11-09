<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use Illuminate\Http\Request;

class EdificioController extends Controller
{
    public function index()
    {
        $edificios = Edificio::paginate(8);
        return view("edificios.index", compact("edificios"));
    }

    public function create()
    {
        $edificio = new Edificio;
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";
        return view("edificios.frm", compact("edificio", "accion", "txtbtn", "des"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreedificio' => 'required|string|max:100',
            'nombrecorto' => 'required|string|max:5',
        ]);
    
        Edificio::create($request->all());
        return redirect()->route("edificios.index")->with("mensaje", "Edificio registrado correctamente.");
    }
    
    public function show(Edificio $edificio)
    {
        $accion = "D";
        $txtbtn = "";
        $des = "disabled";
        return view("edificios.frm", compact("edificio", "accion", "txtbtn", "des"));
    }

    public function edit(Edificio $edificio)
    {
        $accion = "E";
        $txtbtn = "Actualizar";
        $des = "";
        return view("edificios.frm", compact("edificio", "accion", "txtbtn", "des"));
    }

    public function update(Request $request, Edificio $edificio)
    {
        $request->validate([
            'nombreedificio' => 'required|string|max:100',
            'nombrecorto' => 'required|string|max:5',
        ]);
    
        $edificio->update($request->all());
        return redirect()->route("edificios.index")->with("mensaje", "Edificio actualizado correctamente.");
    }

    public function destroy(Edificio $edificio)
    {
        $edificio->delete();
        return redirect()->route("edificios.index")->with("mensaje", "Edificio eliminado correctamente.");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PersonalPlaza;
use App\Models\Plaza;
use App\Models\Personal;
use Illuminate\Http\Request;

class PersonalPlazaController extends Controller
{
    public function index()
    {
        $personalPlazas = PersonalPlaza::with(['plaza', 'personal'])->paginate(8);
        return view("personalplazas.index", compact("personalPlazas"));
    }

    public function create()
    {
        $plazas = Plaza::all();
        $personales = Personal::all();
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";
        
        return view("personalplazas.frm", compact("accion", "txtbtn", "des", "plazas", "personales"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tiponombramiento' => 'required|string|max:100',
            'plaza_id' => 'required|exists:plazas,id',
            'personal_id' => 'required|exists:personals,id',
        ]);

        PersonalPlaza::create($request->all());
        return redirect()->route("personalplazas.index")->with("mensaje", "Asignación de plaza registrada correctamente.");
    }

    public function edit($id)
    {
        $personalPlaza = PersonalPlaza::findOrFail($id);
        $plazas = Plaza::all();
        $personales = Personal::all();
        $accion = "E";
        $txtbtn = "Actualizar";
        $des = "";
    
        return view("personalplazas.frm", compact("personalPlaza", "accion", "txtbtn", "des", "plazas", "personales"));
    }
    
    public function update(Request $request, $id)
    {
        $personalPlaza = PersonalPlaza::findOrFail($id);
        
        $request->validate([
            'tiponombramiento' => 'required|string|max:100',
            'plaza_id' => 'required|exists:plazas,id',
            'personal_id' => 'required|exists:personals,id',
        ]);

        $personalPlaza->update($request->all());
        return redirect()->route("personalplazas.index")->with("mensaje", "Asignación de plaza actualizada correctamente.");
    }

    public function show($id)
    {
        $personalPlaza = PersonalPlaza::findOrFail($id);
        $plazas = Plaza::all();
        $personales = Personal::all();
        $accion = "D";
        $txtbtn = "";
        $des = "disabled";

        return view("personalplazas.frm", compact("personalPlaza", "accion", "txtbtn", "des", "plazas", "personales"));
    }

    public function destroy($id)
    {
        $personalPlaza = PersonalPlaza::findOrFail($id);
        $personalPlaza->delete();

        return redirect()->route("personalplazas.index")->with("mensaje", "Asignación de plaza eliminada correctamente.");
    }
}
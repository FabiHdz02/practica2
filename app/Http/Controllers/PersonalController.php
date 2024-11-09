<?php

namespace App\Http\Controllers;

use App\Models\Depto;
use App\Models\Personal;
use App\Models\Puesto;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function index()
    {
        $personales = Personal::paginate(8); // Paginamos los registros
        return view("personals.index", compact("personales"));
    }

    public function create()
    {
        $personal = new Personal;
        $deptos = Depto::all(); // Obtenemos los departamentos
        $puestos = Puesto::all(); // Obtenemos los puestos
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";
        return view("personals.frm", compact("personal", "accion", "txtbtn", "des", "deptos", "puestos"));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'RFC' => 'required|string|max:100',
            'nombres' => 'required|string|max:50',
            'apellidop' => 'required|string|max:50',
            'apellidom' => 'required|string|max:50',
            'licenciatura' => 'required|string|max:200',
            'lictit' => 'required|boolean',
            'especializacion' => 'nullable|string|max:200',
            'esptit' => 'required|boolean',
            'maestria' => 'nullable|string|max:200',
            'maetit' => 'required|boolean',
            'doctorado' => 'nullable|string|max:200',
            'doctit' => 'required|boolean',
            'fechaingsep' => 'required|date',
            'fechaingins' => 'required|date',
            'depto_id' => 'required',
            'puesto_id' => 'required',
        ]);
        Personal::create($request->all()); // Guardamos el registro
        return redirect()->route("personals.index")->with("mensaje", "Personal registrado correctamente.");
    }

    public function show(Personal $personal)
    {
        $accion = "D";
        $txtbtn = "";
        $des = "disabled";
        return view("personals.frm", compact("personal", "accion", "txtbtn", "des"));
    }

    public function edit(Personal $personal)
    {
        $deptos = Depto::all();
        $puestos = Puesto::all();
        $accion = "E";
        $txtbtn = "Actualizar";
        $des = "";
        return view("personals.frm", compact("personal", "accion", "txtbtn", "des", "deptos", "puestos"));
    }

    public function update(Request $request, Personal $personal)
    {
        $request->validate([
            'RFC' => 'required|string|max:100',
            'nombres' => 'required|string|max:50',
            'apellidop' => 'required|string|max:50',
            'apellidom' => 'required|string|max:50',
            'licenciatura' => 'required|string|max:200',
            'lictit' => 'required|boolean',
            'especializacion' => 'nullable|string|max:200',
            'esptit' => 'required|boolean',
            'maestria' => 'nullable|string|max:200',
            'maetit' => 'required|boolean',
            'doctorado' => 'nullable|string|max:200',
            'doctit' => 'required|boolean',
            'fechaingsep' => 'required|date',
            'fechaingins' => 'required|date',
            'depto_id' => 'required',
            'puesto_id' => 'required',
        ]);

        $personal->update($request->all()); // Actualizamos el registro
        return redirect()->route("personals.index")->with("mensaje", "Personal actualizado correctamente.");
    }

    public function destroy(Personal $personal)
    {
        $personal->delete();
        return redirect()->route("personals.index")->with("mensaje", "Personal eliminado correctamente.");
    }
}

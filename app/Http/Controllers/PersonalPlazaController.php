<?php

namespace App\Http\Controllers;

use App\Models\PersonalPlaza;
use App\Models\Plaza;
use App\Models\Personal;
use Illuminate\Http\Request;

class PersonalPlazaController extends Controller
{
    // Muestra la lista de PersonalPlazas
    public function index()
    {
        $personalPlazas = PersonalPlaza::paginate(8);
        return view("personalplazas.index", compact("personalPlazas"));
    }

    // Muestra el formulario para crear un nuevo PersonalPlaza
    public function create()
    {
        // Obtener todas las plazas y personales
        $plazas = Plaza::all();
        $personales = Personal::all();
        
        // Datos para la vista
        $accion = "C";  // C para Crear
        $txtbtn = "Guardar";
        $des = "";  // No está deshabilitado

        return view("personalplazas.frm", compact("accion", "txtbtn", "des", "plazas", "personales"));
    }

    // Guarda un nuevo PersonalPlaza
    public function store(Request $request)
    {
        $request->validate([
            'tiponombramiento' => 'required|string|max:100',
            'plaza_id' => 'required|exists:plazas,id',
            'personal_id' => 'required|exists:personals,id',
        ]);

        // Crear el PersonalPlaza
        PersonalPlaza::create($request->all());

        // Redirigir con mensaje
        return redirect()->route("personalplazas.index")->with("mensaje", "Asignación de plaza registrada correctamente.");
    }

    // Muestra el formulario para editar un PersonalPlaza
    public function edit(PersonalPlaza $personalPlaza)
    {
        // Obtener todas las plazas y personales
        $plazas = Plaza::all();
        $personales = Personal::all();
        
        // Datos para la vista
        $accion = "E";  // E para Editar
        $txtbtn = "Actualizar";
        $des = "";  // No está deshabilitado

        return view("personalplazas.frm", compact("personalPlaza", "accion", "txtbtn", "des", "plazas", "personales"));
    }

    // Actualiza un PersonalPlaza existente
    public function update(Request $request, PersonalPlaza $personalPlaza)
    {
        $request->validate([
            'tiponombramiento' => 'required|string|max:100',
            'plaza_id' => 'required|exists:plazas,id',
            'personal_id' => 'required|exists:personals,id',
        ]);

        // Actualizar el PersonalPlaza
        $personalPlaza->update($request->all());

        // Redirigir con mensaje
        return redirect()->route("personalplazas.index")->with("mensaje", "Asignación de plaza actualizada correctamente.");
    }

    // Muestra los detalles de un PersonalPlaza
    public function show(PersonalPlaza $personalPlaza)
    {
        $plazas = Plaza::all();
        $personales = Personal::all();
        $accion = "D";  // D para Eliminar (disabled)
        $txtbtn = "";   // No hay botón para guardar
        $des = "disabled";  // Campo deshabilitado

        return view("personalplazas.frm", compact("personalPlaza", "accion", "txtbtn", "des", "plazas", "personales"));
    }

    // Elimina un PersonalPlaza
    public function destroy(PersonalPlaza $personalPlaza)
    {
        $personalPlaza->delete();

        return redirect()->route("personalplazas.index")->with("mensaje", "Asignación de plaza eliminada correctamente.");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Plaza; // Asegúrate de tener el modelo Plaza
use Illuminate\Http\Request;

class PlazaController extends Controller
{
    protected $val;

    public function __construct()
    {
        $this->val = [
            'idplaza' => ['required', 'string', 'max:10', 'unique:plazas,idplaza'],
            'nombreplaza' => ['required', 'string', 'max:200'],
        ];
    }

    public function index()
    {
        $plazas = Plaza::paginate(8); // Paginar las plazas
        return view("plazas.index", compact("plazas"));
    }

    public function create()
    {
        $plaza = new Plaza;
        $accion = "C";
        $txtbtn = "Guardar";
        $des = "";
        return view("plazas.frm", compact("plaza", "accion", "txtbtn", "des"));
    }

    public function store(Request $request)
    {
        $val = $request->validate($this->val); // Validar los datos
        Plaza::create($val); // Crear una nueva plaza
        return redirect()->route("plazas.index")->with("mensaje", "Plaza registrada correctamente.");
    }

    public function show(Plaza $plaza)
    {
        $accion = "D";
        $txtbtn = "Confirmar Eliminación";
        $des = "disabled";
        return view("plazas.frm", compact("plaza", "accion", "txtbtn", "des"));
    }

    public function edit(Plaza $plaza)
    {
        $accion = "E";
        $txtbtn = "Actualizar";
        $des = "";
        return view("plazas.frm", compact("plaza", "accion", "txtbtn", "des"));
    }

    public function update(Request $request, Plaza $plaza)
    {
        // Actualiza la plaza con todos los datos del formulario
        $plaza->update($request->all());
        return redirect()->route("plazas.index")->with("mensaje", "Plaza actualizada correctamente.");
    }

    public function destroy(Plaza $plaza)
    {
        $plaza->delete(); // Elimina la plaza
        return redirect()->route("plazas.index")->with("mensaje", "Plaza eliminada correctamente.");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use App\Models\Lugar;
use Illuminate\Http\Request;

class LugarController extends Controller
{
    public $val;

    public function __construct()
    {
        // Definimos las reglas de validación
        $this->val = [
            'nombrelugar' => ['required', 'max:25'],
            'nombrecorto' => ['required', 'max:5'],
            'edificio_id' => ['required', 'exists:edificios,id']
        ];
    }

    // Mostrar la lista de lugares
    public function index()
    {
        $lugares = Lugar::paginate(8);  // Paginación de 8 lugares por página
        return view("lugares.index", compact("lugares"));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        $edificios = Edificio::all();  // Obtenemos todos los edificios
        $lugar = new Lugar;  // Creamos una nueva instancia de Lugar
        $accion = "C";  // Indicamos que es una creación
        $txtbtn = "Guardar";  // Texto del botón
        $des = "";  // Deshabilitamos el campo si es necesario
        return view("lugares.frm", compact("lugar", "edificios", "accion", "txtbtn", "des"));
    }

    // Guardar un nuevo lugar
    public function store(Request $request)
    {
        $val = $request->validate($this->val);  // Validamos los datos
        Lugar::create($val);  // Creamos el lugar con los datos validados
        return redirect()->route("lugares.index")->with("mensaje", "Lugar registrado correctamente.");
    }

    // Mostrar los detalles de un lugar
    public function show(Lugar $lugar)
    {
        $edificios = Edificio::all();  // Obtenemos todos los edificios
        $accion = "D";  // Indicamos que es solo para ver los detalles
        $txtbtn = "";  // No hay botón de acción
        $des = "disabled";  // Los campos estarán deshabilitados
        return view("lugares.frm", compact("lugar", "edificios", "accion", "txtbtn", "des"));
    }

    // Mostrar el formulario de edición
    public function edit(Lugar $lugar)
    {
        $edificios = Edificio::all();  // Obtenemos todos los edificios
        $accion = "E";  // Indicamos que es una edición
        $txtbtn = "Actualizar";  // Texto del botón
        $des = "";  // Los campos estarán habilitados para editar
        return view("lugares.frm", compact('lugar', 'edificios', 'accion', 'txtbtn', 'des'));
    }

    // Actualizar un lugar existente
    public function update(Request $request, Lugar $lugar)
    {
        $val = $request->validate($this->val);  // Validamos los datos
        $lugar->update($val);  // Actualizamos el lugar con los nuevos datos
        return redirect()->route("lugares.index")->with("mensaje", "Lugar actualizado correctamente.");
    }

    // Eliminar un lugar
    public function destroy(Lugar $lugar)
    {
        $lugar->delete();  // Eliminamos el lugar
        return redirect()->route("lugares.index")->with("mensaje", "Lugar eliminado correctamente.");
    }
}

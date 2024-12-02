<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lugar;
use App\Models\Edificio;

class LugarController extends Controller
{
    /**
     * Muestra la lista de lugares.
     */
    public function index()
    {
        $lugares = Lugar::with('edificio')->paginate(10); // Paginar la lista de lugares con sus edificios
        return view('lugares.index', compact('lugares'));
    }

    /**
     * Muestra el formulario para crear un lugar.
     */
    public function create()
    {
        $accion = 'C';
        $txtbtn = 'Registrar';
        $edificios = Edificio::all(); // Obtener lista de edificios
        return view('lugares.frm', compact('accion', 'txtbtn', 'edificios'));
    }

    /**
     * Guarda un nuevo lugar.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombrelugar' => 'required|string|max:100',
            'nombrecorto' => 'required|string|max:50',
            'edificio_id' => 'required|exists:edificios,id',
        ]);

        Lugar::create($request->all());

        return redirect()->route('lugares.index')->with('success', 'Lugar registrado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un lugar.
     */
    public function edit($id)
    {
        $lugar = Lugar::findOrFail($id);
        $accion = 'E';
        $txtbtn = 'Actualizar';
        $edificios = Edificio::all(); // Obtener lista de edificios
        return view('lugares.frm', compact('lugar', 'accion', 'txtbtn', 'edificios'));
    }

    /**
     * Actualiza un lugar existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombrelugar' => 'required|string|max:100',
            'nombrecorto' => 'required|string|max:50',
            'edificio_id' => 'required|exists:edificios,id',
        ]);

        $lugar = Lugar::findOrFail($id);
        $lugar->update($request->all());

        return redirect()->route('lugares.index')->with('success', 'Lugar actualizado exitosamente.');
    }

    /**
     * Muestra el formulario para eliminar un lugar.
     */
    public function destroy(Request $request, $id)
    {
        $lugar = Lugar::findOrFail($id);
        $lugar->delete();

        return redirect()->route('lugares.index')->with('success', 'Lugar eliminado exitosamente.');
    }
}

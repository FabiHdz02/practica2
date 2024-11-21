<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Models\Alumno;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function index()
    {
        $turnos = Turno::with('alumno')->paginate(8); // Paginación con 8 registros por página
        return view('turnos.index', compact('turnos'));
    }

    public function create()
    {
        $turno = new Turno;
        $alumnos = Alumno::all(); // Lista de alumnos para el selector
        $accion = 'C'; // Acción para identificar creación
        return view('turnos.frm', compact('turno', 'alumnos', 'accion'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'codigocanal' => 'required|string|max:45',
            'alumno_id' => 'required|exists:alumnos,id',
        ]);

        Turno::create($request->all());
        return redirect()->route('turnos.index')->with('mensaje', 'Turno registrado correctamente.');
    }

    public function edit(Turno $turno)
    {
        $alumnos = Alumno::all(); // Lista de alumnos para el selector
        $accion = 'E'; // Acción para identificar edición
        return view('turnos.frm', compact('turno', 'alumnos', 'accion'));
    }

    public function update(Request $request, Turno $turno)
    {
        $request->validate([
            'fecha' => 'required|date',
            'codigocanal' => 'required|string|max:45',
            'alumno_id' => 'required|exists:alumnos,id',
        ]);

        // Actualizar campos excepto 'hora' si no se incluye
        $turno->update($request->only(['fecha', 'codigocanal', 'alumno_id']));

        return redirect()->route('turnos.index')->with('mensaje', 'Turno actualizado correctamente.');
    }

    public function destroy(Turno $turno)
    {
        $turno->delete();
        return redirect()->route('turnos.index')->with('mensaje', 'Turno eliminado correctamente.');
    }
}

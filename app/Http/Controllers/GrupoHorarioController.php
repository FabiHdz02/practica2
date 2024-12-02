<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Lugar;
use App\Models\Edificio;
use App\Models\GrupoHorario;
use Illuminate\Http\Request;

class GrupoHorarioController extends Controller
{
    public function index()
    {
        $grupoHorarios = GrupoHorario::with('grupo', 'lugar')->paginate(10);
        return view('grupohorarios.index', compact('grupoHorarios'));
    }

    public function create()
    {
        $grupos = Grupo::all();
        $lugares = Lugar::all();
        $edificios = Edificio::all(); // Cargar todos los edificios
        $accion = 'C';
    
        return view('grupohorarios.frm', compact('grupos', 'lugares', 'edificios', 'accion'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|integer',
            'dia' => 'required|string|max:10',
            'hora' => 'required|string|max:10' . $request->grupo_id,
        ]);

        $grupoHorario = GrupoHorario::create($request->all());

        // Redirigir al método edit del controlador Grupo
        return redirect()->route('grupos.edit', $grupoHorario->grupo_id)
            ->with('success', 'Horario creado exitosamente.');
    }

    public function edit($id)
    {
        $grupoHorario = GrupoHorario::findOrFail($id);
        $grupos = Grupo::all();
        $lugares = Lugar::all();
        $edificios = Edificio::all(); // Cargar todos los edificios
        $accion = 'E';
    
        return view('grupohorarios.frm', compact('grupoHorario', 'grupos', 'lugares', 'edificios', 'accion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'lugar_id' => 'required|exists:lugars,id',
            'dia' => 'required|string|min:0|max:6',
            'hora' => 'required',
        ]);

        $grupoHorario = GrupoHorario::findOrFail($id);
        $grupoHorario->update($request->all());

        return redirect()->route('grupohorarios.index')
            ->with('success', 'Horario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $grupoHorario = GrupoHorario::findOrFail($id);
        $grupo_id = $grupoHorario->grupo_id; // Guardar el grupo_id antes de eliminar
        $grupoHorario->delete();

        // Redirigir al método edit del controlador Grupo
        return redirect()->route('grupos.edit', $grupo_id)
            ->with('success', 'Horario eliminado exitosamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Lugar;
use App\Models\Grupo21343;
use Illuminate\Http\Request;
use App\Models\GrupoHorario21343;

class GrupoHorario21343Controller extends Controller
{
    public function index21343()
    {
        $grupoHorarios = GrupoHorario21343::with('grupo', 'lugar')->paginate(10);
        return view('grupohorarios21343.index21343', compact('grupoHorarios'));
    }

    public function create()
    {
        $grupos = Grupo21343::all();
        $lugares = Lugar::all();
        $accion = 'C';
        return view('grupohorarios21343.frm', compact('grupos', 'lugares', 'accion'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|integer',
            'dia' => 'required|string|max:10',
            'hora' => 'required|string|max:10|unique:grupo_horario21343s,hora,NULL,id,grupo_id,' . $request->grupo_id,
        ]);

        $grupoHorario = GrupoHorario21343::create($request->all());

        // Redirigir al método edit del controlador Grupo21343
        return redirect()->route('grupos21343.edit', $grupoHorario->grupo_id)
            ->with('success', 'Horario creado exitosamente.');
    }

    public function edit($id)
    {
        $grupoHorario = GrupoHorario21343::findOrFail($id);
        $grupos = Grupo21343::all();
        $lugares = Lugar::all();
        $accion = 'E';
        return view('grupohorarios21343.frm', compact('grupoHorario', 'grupos', 'lugares', 'accion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'lugar_id' => 'required|exists:lugars,id',
            'dia' => 'required|string|min:0|max:6',
            'hora' => 'required',
        ]);

        $grupoHorario = GrupoHorario21343::findOrFail($id);
        $grupoHorario->update($request->all());

        return redirect()->route('grupohorarios21343.index21343')
            ->with('success', 'Horario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $grupoHorario = GrupoHorario21343::findOrFail($id);
        $grupo_id = $grupoHorario->grupo_id; // Guardar el grupo_id antes de eliminar
        $grupoHorario->delete();

        // Redirigir al método edit del controlador Grupo21343
        return redirect()->route('grupos21343.edit', $grupo_id)
            ->with('success', 'Horario eliminado exitosamente.');
    }
}

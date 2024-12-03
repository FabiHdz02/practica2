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
    // Validación de los datos
    $request->validate([
        'grupo_id' => 'required|integer',
        'lugar_id' => 'required|exists:lugars,id',  // Validación de lugar_id
        'dia' => 'required|string|max:10',
        'hora' => 'required|string|max:10',
    ]);

    // Verificar si ya existe un horario en el mismo grupo y hora para un lugar diferente
    $existeHorario = GrupoHorario::where('grupo_id', $request->grupo_id)
        ->where('dia', $request->dia)
        ->where('hora', $request->hora)
        ->where('lugar_id', '<>', $request->lugar_id) // Asegurarnos de que no sea el mismo lugar
        ->exists();

    if ($existeHorario) {
        // Si ya existe un horario en esa hora para el mismo grupo en un lugar diferente
        return response()->json(['error' => 'La hora ya está ocupada en otro lugar para el mismo grupo'], 400);
    }

    // *Nueva validación*: Verificar si ya existe un horario en el mismo edificio, lugar, día y hora para otro grupo
    $existeEmpalme = GrupoHorario::where('lugar_id', $request->lugar_id)
        ->where('dia', $request->dia)
        ->where('hora', $request->hora)
        ->where('grupo_id', '<>', $request->grupo_id) // Excluir el mismo grupo
        ->exists();

    if ($existeEmpalme) {
        // Si existe un empalme con otro grupo
        return response()->json([
            'error' => 'El edificio, lugar, día y hora ya están ocupados por otro grupo'
        ], 400);
    }
    
    // Obtener el lugar y extraer el edificio_id
    $lugar = Lugar::findOrFail($request->lugar_id);
    $edificio_id = $lugar->edificio_id;
    
    // Almacenar los valores en la sesión
    session([
        'edificio_id' => $edificio_id,
        'lugar_id' => $request->lugar_id
    ]);
    
    // Crear el horario
    $grupoHorario = GrupoHorario::create([
        'grupo_id' => $request->grupo_id,
        'lugar_id' => $request->lugar_id,
        'edificio_id' => $edificio_id,  // Almacenar edificio_id
        'dia' => $request->dia,
        'hora' => $request->hora,
    ]);
    
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
        // Validación de los datos
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'lugar_id' => 'required|exists:lugars,id',
            'dia' => 'required|string|max:6',
            'hora' => 'required',
        ]);
    
        // Obtener el lugar y extraer el edificio_id
        $lugar = Lugar::findOrFail($request->lugar_id);
        $edificio_id = $lugar->edificio_id;
    
        // Almacenar los valores en la sesión
        session([
            'edificio_id' => $edificio_id,
            'lugar_id' => $request->lugar_id
        ]);
    
        // Actualizar el horario
        $grupoHorario = GrupoHorario::findOrFail($id);
        $grupoHorario->update([
            'grupo_id' => $request->grupo_id,
            'lugar_id' => $request->lugar_id,
            'edificio_id' => $edificio_id,  // Actualizar edificio_id
            'dia' => $request->dia,
            'hora' => $request->hora,
        ]);
    
        return redirect()->route('grupohorarios.index')
            ->with('success', 'Horario actualizado exitosamente.');
    }


    public function checkHorarioOcupado(Request $request)
{
    // Verificar si ya existe un horario en el mismo grupo y hora para un lugar diferente
    $existeHorario = GrupoHorario::where('grupo_id', $request->grupo_id)
        ->where('dia', $request->dia)
        ->where('hora', $request->hora)
        ->where('lugar_id', '<>', $request->lugar_id) // Asegurarnos de que no sea el mismo lugar
        ->exists();

    if ($existeHorario) {
        return response()->json(['error' => 'La hora ya está ocupada en otro lugar para el mismo grupo'], 400);
    }

    // *Nueva validación*: Verificar si ya existe un horario en el mismo lugar, día, hora y edificio para otro grupo
    $existeEmpalme = GrupoHorario::where('lugar_id', $request->lugar_id)
        ->where('dia', $request->dia)
        ->where('hora', $request->hora)
        ->where('grupo_id', '<>', $request->grupo_id) // Excluir el mismo grupo
        ->exists();

    if ($existeEmpalme) {
        // Si existe un empalme con otro grupo
        return response()->json([
            'error' => 'El edificio, lugar, día y hora ya están ocupados por otro grupo'
        ], 400);
    }

    return response()->json(['success' => 'El horario está disponible'], 200);
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
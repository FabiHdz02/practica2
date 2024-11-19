<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\GrupoHorario;
use Illuminate\Http\Request;

class GrupoHorarioController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'grupo_id' => 'required|exists:grupos,id', // Validar que el grupo exista
            'lugar_id' => 'required|exists:lugars,id', // Validar que el lugar exista
            'horarios' => 'required|array', // Validar que haya horarios seleccionados
            'horarios.*' => 'regex:/^\d-\d{2}:\d{2}$/', // Validar formato "día-hora"
        ]);

        // Iterar sobre los horarios seleccionados y crear registros
        foreach ($validatedData['horarios'] as $horario) {
            // Separar el horario en día y hora
            [$dia, $hora] = explode('-', $horario);

            // Insertar en la tabla grupo_horarios
            GrupoHorario::create([
                'grupo_id' => $validatedData['grupo_id'],
                'lugar_id' => $validatedData['lugar_id'],
                'dia' => $dia,
                'hora' => $hora,
            ]);
        }

        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Horarios registrados con éxito.');
    }

    public function updateHorarios(Request $request, $id)
    {
        // Validación de los datos entrantes (permitiendo campos opcionales)
        $request->validate([
            'horarios.*.dia' => 'nullable|integer|min:0|max:4', // Día opcional
            'horarios.*.hora' => 'nullable|date_format:H:i',    // Hora opcional
            'horarios.*.edificio_id' => 'nullable|exists:edificios,id', // Edificio opcional
            'horarios.*.lugar_id' => 'nullable|exists:lugars,id',     // Lugar opcional
        ]);

        try {
            // Obtén el grupo correspondiente
            $grupo = Grupo::findOrFail($id);

            // Recorre los horarios enviados y actualízalos si están completos
            if ($request->has('horarios')) {
                foreach ($request->horarios as $horarioId => $horarioData) {
                    $grupoHorario = GrupoHorario::findOrFail($horarioId);

                    // Verifica que el horario pertenece al grupo actual
                    if ($grupoHorario->grupo_id != $grupo->id) {
                        return redirect()->back()->withErrors(['error' => 'Horario no válido para este grupo.']);
                    }

                    // Actualiza los datos del horario si están presentes
                    $grupoHorario->update(array_filter([
                        'dia' => $horarioData['dia'] ?? null,
                        'hora' => $horarioData['hora'] ?? null,
                        'lugar_id' => $horarioData['lugar_id'] ?? null,
                    ]));
                }
            }

            return redirect()->route('grupos.index')->with('success', 'Horarios actualizados correctamente.');
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->back()->withErrors(['error' => 'Hubo un error al actualizar los horarios: ' . $e->getMessage()]);
        }
    }
    
}
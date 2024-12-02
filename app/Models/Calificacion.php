<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    /** @use HasFactory<\Database\Factories\CalificacionFactory> */
    use HasFactory;
    protected $fillable = [
        'calificacion', 'alumno_id', 'horario_alumno_id', 'horario_grupo_id'
    ];

    // Relación con Alumno
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    // Relación con HorarioAlumno
    public function horarioAlumno()
    {
        return $this->belongsTo(HorarioAlumno::class);
    }

    // Relación con HorarioGrupo
    public function horarioGrupo()
    {
        return $this->belongsTo(GrupoHorario::class);
    }
}

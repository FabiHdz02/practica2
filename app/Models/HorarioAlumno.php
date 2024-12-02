<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HorarioAlumno extends Model
{
    /** @use HasFactory<\Database\Factories\HorarioAlumnoFactory> */
    use HasFactory;

    protected $fillable = ['alumno_id', 'grupo_horario_id'];

    public function alumno(): BelongsTo
    {
        return $this->belongsTo(Alumno::class);
    }

    public function grupoHorario(): BelongsTo
    {
        return $this->belongsTo(GrupoHorario::class);
    }

    public function calificacion()
    {
        return $this->hasOne(Calificacion::class, 'horario_alumno_id');
    }

}

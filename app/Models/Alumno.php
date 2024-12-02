<?php

namespace App\Models;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumno extends Model
{
    /** @use HasFactory<\Database\Factories\AlumnoFactory> */
    use HasFactory;
    protected $fillable = [
        'noctrl',
        'nombre',
        'apellidop',
        'apellidom',
        'sexo',
        'semestre',
        'carrera_id'
    ];

    public function carrera(): BelongsTo {
        return $this->belongsTo(Carrera::class);
    }
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    // Relación con GrupoHorario
    public function grupoHorario()
    {
        return $this->belongsTo(GrupoHorario::class, 'grupo_horario_id');
    }

     // Relación con Calificacion
     public function calificacion()
     {
         return $this->hasOne(Calificacion::class, 'horario_alumno_id');
    }
}

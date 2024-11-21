<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grupo extends Model
{
    /** @use HasFactory<\Database\Factories\GrupoFactory> */
    use HasFactory;

    protected $fillable = [
        'grupo',
        'descripcion',
        'maxalumnos',
        'fecha',
        'periodo_id',
        'materia_abierta_id',
        'personal_id'
    ];

    // Relación con el modelo Periodo
    public function periodo(): BelongsTo
    {
        return $this->belongsTo(Periodo::class);
    }

    // Relación con el modelo Materia
    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class);
    }

    public function materiaAbierta(): BelongsTo 
    {
        return $this->belongsTo(MateriaAbierta::class);
    }

    // Relación con el modelo Personal
    public function personal(): BelongsTo
    {
        return $this->belongsTo(Personal::class);
    }

    // Relación con el modelo GrupoHorario (si aplica)
    public function grupoHorarios(): HasMany
    {
        return $this->hasMany(GrupoHorario::class);
    }
}

<?php

namespace App\Models;

use App\Models\Materia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MateriaAbierta extends Model
{
    /** @use HasFactory<\Database\Factories\MateriaAbiertaFactory> */
    use HasFactory;

    protected $fillable = [
        'materia_id',
        'periodo_id',
        'carrera_id',
    ];

    // En el modelo de MateriaAbierta
    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    // En el modelo de MateriaAbierta
    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    public function periodo(): BelongsTo
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

}

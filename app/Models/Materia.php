<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materia extends Model
{
    /** @use HasFactory<\Database\Factories\MateriaFactory> */
    use HasFactory;

    protected $fillable = [
        'idmateria',
        'nombremateria',
        'nivel',
        'nombrecorto',
        'modalidad',
        'semestre',
        'credito',
        'reticula_id',
    ];

    public function reticula(): BelongsTo {
        return $this->belongsTo(Reticula::class);
    }

    // En el modelo de Materia
    public function materiasAbiertas(): HasMany
    {
        return $this->hasMany(MateriaAbierta::class, 'materia_id');
    }

}

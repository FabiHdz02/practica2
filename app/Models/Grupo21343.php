<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grupo21343 extends Model
{
    protected $table = 'grupo21343s';

    protected $fillable = [
        'grupo', 
        'descripcion', 
        'maxalumnos', 
        'fecha', 
        'periodo_id', 
        'personal_id',
        'materia_abierta_id'
    ];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

    public function materiaAbierta()
    {
        return $this->belongsTo(MateriaAbierta::class, 'materia_abierta_id');
    }

    public function horarios()
    {
        return $this->hasMany(GrupoHorario21343::class, 'grupo_id');
    }

}
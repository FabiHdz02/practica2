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
        'carrera_id'
    ];

    public function carrera(): BelongsTo {
        return $this->belongsTo(Carrera::class);
    }
}

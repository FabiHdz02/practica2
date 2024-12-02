<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoHorario21343 extends Model
{
    /** @use HasFactory<\Database\Factories\GrupoHorario21343Factory> */
    use HasFactory;

    protected $fillable = [
        'grupo_id',
        'lugar_id',
        'dia',
        'hora',
    ];

    // Relaciones
    public function grupo()
    {
        return $this->belongsTo(Grupo21343::class, 'grupo_id');
    }


    public function lugar()
    {
        return $this->belongsTo(Lugar::class);
    }
}

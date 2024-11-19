<?php

namespace App\Models;

use App\Models\Grupo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GrupoHorario extends Model
{
    /** @use HasFactory<\Database\Factories\GrupoHorarioFactory> */
    use HasFactory;

    protected $fillable = [
        'grupo_id',
        'lugar_id',
        'dia',
        'hora',
    ];

    public function grupo() : BelongsTo
    {
        return $this->belongsTo(Grupo::class, 'grupo_id', 'id');
    }

    public function lugar()
    {
        return $this->belongsTo(Lugar::class, 'lugar_id', 'id');
    }

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'edificio_id', 'id');
    }
}
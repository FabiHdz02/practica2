<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'reticula_id',
    ];

    public function reticula(): BelongsTo {
        return $this->belongsTo(Reticula::class);
    }
}

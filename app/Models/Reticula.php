<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reticula extends Model
{
    /** @use HasFactory<\Database\Factories\ReticulaFactory> */
    use HasFactory;
    
    protected $fillable = [
        'idreticula',
        'descripcion',
        'fechavigor',
        'carrera_id',
    ];    


    public function carrera(): BelongsTo {
        return $this->belongsTo(Carrera::class);
    }

    public function materias(): HasMany{
        return $this->hasMany(Materia::class);
    }
}

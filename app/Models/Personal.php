<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Personal extends Model
{
    /** @use HasFactory<\Database\Factories\PersonalFactory> */
    use HasFactory;

    protected $fillable = [
        'RFC',
        'nombres',
        'apellidop',
        'apellidom',
        'licenciatura',
        'lictit',
        'especializacion',
        'esptit',
        'maestria',
        'maetit',
        'doctorado',
        'doctit',
        'fechaingsep',
        'fechaingins',
        'depto_id',
        'puesto_id',
    ];

    public function depto(): BelongsTo
    {
        return $this->belongsTo(Depto::class);
    }

    // Relación con Puesto (un Personal pertenece a un Puesto)
    public function puesto(): BelongsTo
    {
        return $this->belongsTo(Puesto::class);
    }

    public function personalPlazas(): HasMany
    {
        return $this->hasMany(PersonalPlaza::class); // Relación con PersonalPlaza
    }
}

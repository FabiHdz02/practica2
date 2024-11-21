<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Documentacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'curp',
        'certificado',
        'cdomi',
        'actanac',
        'tipoinsc_id',
        'alumno_id',
    ];

    public function tipoinsc(): BelongsTo
    {
        return $this->belongsTo(Tipoinsc::class);
    }

    public function alumno(): BelongsTo
    {
        return $this->belongsTo(Alumno::class);
    }
}
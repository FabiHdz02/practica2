<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalPlaza extends Model
{
    /** @use HasFactory<\Database\Factories\PersonalPlazaFactory> */
    use HasFactory;

    protected $fillable = [
        'tiponombramiento',
        'plaza_id',
        'personal_id',
    ];

    public function plaza(): BelongsTo
    {
        return $this->belongsTo(Plaza::class); // Relación con Plaza
    }

    // Relación con el modelo Personal (belongsTo)
    public function personal(): BelongsTo
    {
        return $this->belongsTo(Personal::class); // Relación con Personal
    }
}

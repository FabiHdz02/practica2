<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plaza extends Model
{
    /** @use HasFactory<\Database\Factories\PlazaFactory> */
    use HasFactory;
    protected $fillable = [
        'idplaza',
        'nombreplaza'
    ];

    public function personalPlazas(): HasMany
    {
        return $this->hasMany(PersonalPlaza::class); // Relación con PersonalPlaza
    }
}

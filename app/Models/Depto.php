<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Depto extends Model
{
    /** @use HasFactory<\Database\Factories\DeptoFactory> */
    use HasFactory;

    protected $fillable = ['iddepto', 'nombredepto', 'nombremediano', 'nombrecorto'];

    public function carrera(): HasMany{
        return $this->hasMany(Carrera::class);
    }

    public function personals(): HasMany
    {
        return $this->hasMany(Personal::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipoinsc extends Model
{
    /** @use HasFactory<\Database\Factories\TipoinscFactory> */
    use HasFactory;

    protected $fillable = [
        'tipo',
        'fecha',
        'periodo_id',
    ];


    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }
}
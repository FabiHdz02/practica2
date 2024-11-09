<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lugar extends Model
{
    /** @use HasFactory<\Database\Factories\LugarFactory> */
    use HasFactory;

    protected $fillable = ['nombrelugar', 'nombrecorto', 'edificio_id'];

    public function edificio(): BelongsTo {
        return $this->belongsTo(Edificio::class);
    }
}

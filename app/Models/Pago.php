<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    /** @use HasFactory<\Database\Factories\PagoFactory> */
    use HasFactory;

    protected $fillable = [
        'monto',
        'fechapago',
        'comprobante',
        'tipo_pago_id',
        'alumno_id',
    ];

    // Relación con TipoPago
    public function tipoPago()
    {
        return $this->belongsTo(TipoPago::class);
    }

    // Relación con Alumno
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}

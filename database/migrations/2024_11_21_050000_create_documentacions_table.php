<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documentacions', function (Blueprint $table) {
            $table->id();
            $table->string('curp', 255); // CURP
            $table->string('certificado', 255); // Certificado
            $table->string('cdomi', 255); // Comprobante de domicilio
            $table->string('actanac', 255); // Acta de nacimiento
            $table->unsignedBigInteger('tipoinsc_id')->constrained(); // Relación con tipoinsc
            $table->unsignedBigInteger('alumno_id')->constrained(); // Relación con alumnos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentacions');
    }
};

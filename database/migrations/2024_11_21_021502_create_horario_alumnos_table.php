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
        Schema::create('horario_alumnos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumno_id')->constrained();
            $table->unsignedBigInteger('grupo_horario_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario_alumnos');
    }
};

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
        Schema::create('calificacions', function (Blueprint $table) {
            $table->id();
            $table->float('calificacion');
            $table->unsignedBigInteger('alumno_id')->constrained();;
            $table->unsignedBigInteger('horario_alumno_id')->constrained();;
            $table->unsignedBigInteger('horario_grupo_id')->constrained();;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacions');
    }
};

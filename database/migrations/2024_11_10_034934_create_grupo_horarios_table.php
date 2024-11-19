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
        Schema::create('grupo_horarios', function (Blueprint $table) {
            $table->id();
            $table->unique(['grupo_id', 'dia', 'hora', 'lugar_id'], 'unique_horario_grupo');
            $table->unsignedBigInteger('grupo_id')->constrained();;
            $table->unsignedBigInteger('lugar_id')->constrained();;
            $table->tinyInteger('dia');
            $table->time('hora');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_horarios');
    }
};

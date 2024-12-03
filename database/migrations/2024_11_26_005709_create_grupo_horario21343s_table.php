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
        Schema::create('grupo_horario21343s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grupo_id')->constrained();
            $table->unsignedBigInteger('lugar_id')->constrained();
            $table->string('dia');
            $table->string('hora');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_horario21343s');
    }
};
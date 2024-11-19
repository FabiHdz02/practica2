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
        Schema::create('personals', function (Blueprint $table) {
            $table->id();
            $table->string('RFC', 100);
            $table->string('nombres', 50);
            $table->string('apellidop', 50);
            $table->string('apellidom', 50);
            $table->string('licenciatura', 200);
            $table->tinyInteger('lictit')->default(0);
            $table->string('especializacion', 200)->nullable();
            $table->tinyInteger('esptit')->default(0);
            $table->string('maestria', 200)->nullable();
            $table->tinyInteger('maetit')->default(0); 
            $table->string('doctorado', 200)->nullable();
            $table->tinyInteger('doctit')->default(0);
            $table->date('fechaingsep'); 
            $table->date('fechaingins'); 
            $table->foreignId('depto_id')->constrained(); 
            $table->foreignId('puesto_id')->constrained(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};

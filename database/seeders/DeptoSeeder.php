<?php

namespace Database\Seeders;

use App\Models\Depto;
use App\Models\Alumno;
use App\Models\Carrera;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Depto::factory(1)->has(
            Carrera::factory(3)->has(
                Alumno::factory(4)
            )
        )->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Alumno;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alumno::factory(10)->create();
    }
}

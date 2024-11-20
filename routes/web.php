<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeptoController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\LugarController;
use App\Http\Controllers\PlazaController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EdificioController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ReticulaController;
use App\Http\Controllers\GrupoHorarioController;
use App\Http\Controllers\PersonalPlazaController;
use App\Http\Controllers\MateriaAbiertaController;

Route::get('/', function () {
    return view('inicio');
});

Route::get('/login', function () {
    return view('login');
})->middleware(['auth'])->name('login');

Route::get('/register', function () {
    return view('register');
})->middleware(['auth'])->name('register');

Route::get('/dashboard', function () {
    return view('inicio');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/menu2', function () {
        return view('menu2');
    })->name('menu2');
});

Route::get('/register', function () {
    return view('register');
})->middleware(['auth'])->name('register');

//Alumno
Route::get('/alumnos.index', [AlumnoController::class, 'index'])->name('alumnos.index');
Route::get('/alumnos.create', [AlumnoController::class, 'create'])->name('alumnos.create');
Route::get('/alumnos.edit/{alumno}', [AlumnoController::class, 'edit'])->name('alumnos.edit');
Route::get('/alumnos.show/{alumno}', [AlumnoController::class, 'show'])->name('alumnos.show');
Route::delete('/alumnos.destroy/{alumno}', [AlumnoController::class, 'destroy'])->name('alumnos.destroy');  // Cambia POST a DELETE
Route::post('/alumnos.update/{alumno}', [AlumnoController::class, 'update'])->name('alumnos.update');
Route::post('/alumnos.store', [AlumnoController::class, 'store'])->name('alumnos.store');

//Puesto
Route::resource('puestos', PuestoController::class);
Route::get('/puestos.index', [PuestoController::class, 'index'])->name('puestos.index');
Route::get('/puestos.create', [PuestoController::class, 'create'])->name('puestos.create');
Route::get('/puestos.edit/{puesto}', [PuestoController::class, 'edit'])->name('puestos.edit');
Route::get('/puestos.show/{puesto}', [PuestoController::class, 'show'])->name('puestos.show');
Route::delete('/puestos.destroy/{puesto}', [PuestoController::class, 'destroy'])->name('puestos.destroy');  // Cambia POST a DELETE
Route::post('/puestos.update/{puesto}', [PuestoController::class, 'update'])->name('puestos.update');
Route::post('/puestos.store', [PuestoController::class, 'store'])->name('puestos.store');

//Depto
Route::get('/deptos', [DeptoController::class, 'index'])->name('deptos.index');
Route::get('/deptos/create', [DeptoController::class, 'create'])->name('deptos.create');
Route::get('/deptos/{depto}/edit', [DeptoController::class, 'edit'])->name('deptos.edit');
Route::get('/deptos/{depto}', [DeptoController::class, 'show'])->name('deptos.show');
Route::delete('/deptos/{depto}', [DeptoController::class, 'destroy'])->name('deptos.destroy');
Route::put('/deptos/{depto}', [DeptoController::class, 'update'])->name('deptos.update');
Route::post('/deptos', [DeptoController::class, 'store'])->name('deptos.store');

//Carrera
Route::get('/carreras.index', [CarreraController::class, 'index'])->name('carreras.index');
Route::get('/carreras.create', [CarreraController::class, 'create'])->name('carreras.create');
Route::get('/carreras.edit/{carrera}', [CarreraController::class, 'edit'])->name('carreras.edit');
Route::get('/carreras.show/{carrera}', [CarreraController::class, 'show'])->name('carreras.show');
Route::delete('/carreras.destroy/{carrera}', [CarreraController::class, 'destroy'])->name('carreras.destroy');
Route::put('/carreras.update/{carrera}', [CarreraController::class, 'update'])->name('carreras.update');
Route::post('/carreras.store', [CarreraController::class, 'store'])->name('carreras.store');

//Plaza
Route::get('/plazas.index', [PlazaController::class, 'index'])->name('plazas.index');
Route::get('/plazas.create', [PlazaController::class, 'create'])->name('plazas.create');
Route::get('/plazas.edit/{plaza}', [PlazaController::class, 'edit'])->name('plazas.edit');
Route::get('/plazas.show/{plaza}', [PlazaController::class, 'show'])->name('plazas.show');
Route::delete('/plazas.destroy/{plaza}', [PlazaController::class, 'destroy'])->name('plazas.destroy');
Route::post('/plazas.update/{plaza}', [PlazaController::class, 'update'])->name('plazas.update');
Route::post('/plazas.store', [PlazaController::class, 'store'])->name('plazas.store');

//Periodo
Route::get('/periodos.index', [PeriodoController::class, 'index'])->name('periodos.index');
Route::get('/periodos.create', [PeriodoController::class, 'create'])->name('periodos.create');
Route::get('/periodos.edit/{periodo}', [PeriodoController::class, 'edit'])->name('periodos.edit');
Route::get('/periodos.show/{periodo}', [PeriodoController::class, 'show'])->name('periodos.show');
Route::delete('/periodos.destroy/{periodo}', [PeriodoController::class, 'destroy'])->name('periodos.destroy');
Route::put('/periodos.update/{periodo}', [PeriodoController::class, 'update'])->name('periodos.update');
Route::post('/periodos.store', [PeriodoController::class, 'store'])->name('periodos.store');

//Reticula
Route::get('/reticulas.index', [ReticulaController::class, 'index'])->name('reticulas.index');
Route::get('/reticulas.create', [ReticulaController::class, 'create'])->name('reticulas.create');
Route::get('/reticulas.edit/{reticula}', [ReticulaController::class, 'edit'])->name('reticulas.edit');
Route::get('/reticulas.show/{reticula}', [ReticulaController::class, 'show'])->name('reticulas.show');
Route::delete('/reticulas.destroy/{reticula}', [ReticulaController::class, 'destroy'])->name('reticulas.destroy');
Route::put('/reticulas.update/{reticula}', [ReticulaController::class, 'update'])->name('reticulas.update');
Route::post('/reticulas.store', [ReticulaController::class, 'store'])->name('reticulas.store');

//Materia
Route::get('/materias.index', [MateriaController::class, 'index'])->name('materias.index');
Route::get('/materias.create', [MateriaController::class, 'create'])->name('materias.create');
Route::get('/materias.edit/{materia}', [MateriaController::class, 'edit'])->name('materias.edit');
Route::get('/materias.show/{materia}', [MateriaController::class, 'show'])->name('materias.show');
Route::delete('/materias.destroy/{materia}', [MateriaController::class, 'destroy'])->name('materias.destroy');
Route::put('/materias.update/{materia}', [MateriaController::class, 'update'])->name('materias.update');
Route::post('/materias.store', [MateriaController::class, 'store'])->name('materias.store');

//Edificio
Route::get('/edificios.index', [EdificioController::class, 'index'])->name('edificios.index');
Route::get('/edificios.create', [EdificioController::class, 'create'])->name('edificios.create');
Route::get('/edificios.edit/{edificio}', [EdificioController::class, 'edit'])->name('edificios.edit');
Route::get('/edificios.show/{edificio}', [EdificioController::class, 'show'])->name('edificios.show');
Route::delete('/edificios.destroy/{edificio}', [EdificioController::class, 'destroy'])->name('edificios.destroy');
Route::put('/edificios.update/{edificio}', [EdificioController::class, 'update'])->name('edificios.update');
Route::post('/edificios.store', [EdificioController::class, 'store'])->name('edificios.store');

//Lugar
Route::get('lugares', [LugarController::class, 'index'])->name('lugares.index');
Route::get('lugares/create', [LugarController::class, 'create'])->name('lugares.create');
Route::post('lugares', [LugarController::class, 'store'])->name('lugares.store');
Route::get('lugares/{lugar}', [LugarController::class, 'show'])->name('lugares.show');
Route::get('lugares/{lugar}/edit', [LugarController::class, 'edit'])->name('lugares.edit');
Route::put('lugares/{lugar}', [LugarController::class, 'update'])->name('lugares.update');
Route::delete('lugares/{lugar}', [LugarController::class, 'destroy'])->name('lugares.destroy');

//Personal
Route::get('personals', [PersonalController::class, 'index'])->name('personals.index');
Route::get('personals/create', [PersonalController::class, 'create'])->name('personals.create');
Route::post('personals', [PersonalController::class, 'store'])->name('personals.store');
Route::get('personals/{personal}', [PersonalController::class, 'show'])->name('personals.show');
Route::get('personals/{personal}/edit', [PersonalController::class, 'edit'])->name('personals.edit');
Route::put('personals/{personal}', [PersonalController::class, 'update'])->name('personals.update');
Route::delete('personals/{personal}', [PersonalController::class, 'destroy'])->name('personals.destroy');

//PlazaPersonal
Route::get('personalplazas', [PersonalPlazaController::class, 'index'])->name('personalplazas.index');
Route::get('personalplazas/create', [PersonalPlazaController::class, 'create'])->name('personalplazas.create');
Route::post('personalplazas', [PersonalPlazaController::class, 'store'])->name('personalplazas.store');
Route::get('personalplazas/{personalPlaza}', [PersonalPlazaController::class, 'show'])->name('personalplazas.show');
Route::get('personalplazas/{personalPlaza}/edit', [PersonalPlazaController::class, 'edit'])->name('personalplazas.edit');
Route::put('personalplazas/{personalPlaza}', [PersonalPlazaController::class, 'update'])->name('personalplazas.update');
Route::delete('personalplazas/{personalPlaza}', [PersonalPlazaController::class, 'destroy'])->name('personalplazas.destroy');

//MateriaAbierta
Route::get('/materiasa.index', [MateriaAbiertaController::class, 'index'])->name('materiasa.index');
Route::post('/materiasa.store', [MateriaAbiertaController::class, 'store'])->name('materiasa.store');

//Grupo-GrupoHorario
Route::get('grupos', [GrupoController::class, 'index'])->name('grupos.index');
Route::get('grupos/create', [GrupoController::class, 'create'])->name('grupos.create');
Route::prefix('grupos')->group(function () {
    Route::post('/store', [GrupoController::class, 'store'])->name('grupos.store');
    Route::post('/horarios/store', [GrupoHorarioController::class, 'store'])->name('grupo_horarios.store');
});
Route::put('/grupos/{grupo}', [GrupoController::class, 'update'])->name('grupos.update');
Route::put('/grupos/{grupo}/horarios', [GrupoHorarioController::class, 'updateHorarios'])->name('grupos.updateHorarios');
Route::get('/grupos/{grupo}/edit', [GrupoController::class, 'edit'])->name('grupos.edit');

//Menu
Route::get('/acerca', function () {
    return view('menu1.acerca');
});
Route::get('/contactanos', function () {
    return view('menu1.contactanos');
});
Route::get('/ayuda', function () {
    return view('menu1.ayuda');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

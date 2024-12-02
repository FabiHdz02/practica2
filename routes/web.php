<?php

use App\Models\Grupo21343;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\DeptoController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\LugarController;
use App\Http\Controllers\PlazaController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EdificioController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ReticulaController;
use App\Http\Controllers\TipoinscController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\Grupo21343Controller;
use App\Http\Controllers\GrupoHorarioController;
use App\Http\Controllers\DocumentacionController;
use App\Http\Controllers\HorarioAlumnoController;
use App\Http\Controllers\PersonalPlazaController;
use App\Http\Controllers\MateriaAbiertaController;
use App\Http\Controllers\GrupoHorario21343Controller;
use App\Models\HorarioAlumno;
Route::get('horario_alumnos/pdf', [HorarioAlumnoController::class, 'pdf'])->name('horario_alumnos.pdf');

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

    Route::get('/menu3', function () {
        return view('menu3');
    })->name('menu3');
});

Route::get('/register', function () {
    return view('register');
})->middleware(['auth'])->name('register');

//Alumno
Route::resource('alumnos', AlumnoController::class);

//Puesto
Route::resource('puestos', PuestoController::class);

//Depto
Route::resource('deptos', DeptoController::class);

//Carrera
Route::resource('carreras', CarreraController::class);

//Plaza
Route::resource('plazas', PlazaController::class);

//Periodo
Route::resource('periodos', PeriodoController::class);

//Reticula
Route::resource('reticulas', ReticulaController::class);

//Materia
Route::resource('materias', MateriaController::class);

//Edificio
Route::resource('edificios', EdificioController::class);

//Lugar
Route::resource('lugares', LugarController::class);

//Personal
Route::resource('personals', PersonalController::class);

//PlazaPersonal
Route::resource('personalplazas', PersonalPlazaController::class);
Route::get('horario_alumnos/frm', [HorarioAlumnoController::class, 'create'])->name('horario_alumnos.frm');

//MateriaAbierta
Route::get('/materiasa.index', [MateriaAbiertaController::class, 'index'])->name('materiasa.index');
Route::post('/materiasa.store', [MateriaAbiertaController::class, 'store'])->name('materiasa.store');

//Grupo-GrupoHorario
Route::resource('grupos', GrupoController::class)->parameters([
    'grupos' => 'grupo'
]);

Route::get('/grupos.index', [GrupoController::class, 'index'])->name('grupos.index');
Route::get('/grupos.create', [GrupoController::class, 'create'])->name('grupos.create');
Route::get('/grupos.edit/{grupo}', [GrupoController::class, 'edit'])->name('grupos.edit');
Route::get('/grupos.show/{grupo}', [GrupoController::class, 'show'])->name('grupos.show');
Route::delete('/grupos.destroy/{grupo}', [GrupoController::class, 'destroy'])->name('grupos.destroy');
Route::put('/grupos.update/{grupo}', [GrupoController::class, 'update'])->name('grupos.update');
Route::post('/grupos.store', [GrupoController::class, 'store'])->name('grupos.store');

// Rutas para GrupoHorario
Route::get('grupohorarios', [GrupoHorarioController::class, 'index'])->name('grupohorarios.index');
Route::get('grupohorarios/create', [GrupoHorarioController::class, 'create'])->name('grupohorarios.create');
Route::post('grupohorarios', [GrupoHorarioController::class, 'store'])->name('grupohorarios.store');
Route::get('grupohorarios/{id}/edit', [GrupoHorarioController::class, 'edit'])->name('grupohorarios.edit');
Route::put('grupohorarios/{id}', [GrupoHorarioController::class, 'update'])->name('grupohorarios.update');
Route::delete('grupohorarios/{id}', [GrupoHorarioController::class, 'destroy'])->name('grupohorarios.destroy');

//Pago
Route::resource('pagos', PagoController::class);

//Calificaciones
Route::middleware('auth')->group(function () {
    Route::get('/calificaciones', [CalificacionController::class, 'index'])->name('calificaciones.index');
});
Route::post('/calificaciones', [CalificacionController::class, 'store'])->name('calificaciones.store');

//Horario_Alumno
Route::resource('horario_alumnos', HorarioAlumnoController::class);

//Tipo_Pago
Route::resource('tipopagos', TipoPagoController::class);

//Turno
Route::resource('turnos', TurnoController::class);

//Tipo_Ins
Route::resource('tipoinscs', TipoinscController::class);

//Documentacion
Route::resource('documentacions', DocumentacionController::class);
Route::post('/tipoinsc', [DocumentacionController::class, 'getTipoInsc'])->name('tipoinsc.get');

//EXAMEN
Route::resource('grupos21343', Grupo21343Controller::class)->parameters([
    'grupos21343' => 'grupo21343'
]);

Route::get('/grupos21343.index21343', [Grupo21343Controller::class, 'index21343'])->name('grupos21343.index21343');
Route::get('/grupos21343.create', [Grupo21343Controller::class, 'create'])->name('grupos21343.create');
Route::get('/grupos21343.edit/{grupo21343}', [Grupo21343Controller::class, 'edit'])->name('grupos21343.edit');
Route::get('/grupos21343.show/{grupo21343}', [Grupo21343Controller::class, 'show'])->name('grupos21343.show');
Route::delete('/grupos21343.destroy/{grupo21343}', [Grupo21343Controller::class, 'destroy'])->name('grupos21343.destroy');
Route::put('/grupos21343.update/{grupo21343}', [Grupo21343Controller::class, 'update'])->name('grupos21343.update');
Route::post('/grupos21343.store', [Grupo21343Controller::class, 'store'])->name('grupos21343.store');

// Rutas para GrupoHorario21343
Route::get('grupohorarios21343', [GrupoHorario21343Controller::class, 'index21343'])->name('grupohorarios21343.index21343');
Route::get('grupohorarios21343/create', [GrupoHorario21343Controller::class, 'create'])->name('grupohorarios21343.create');
Route::post('grupohorarios21343', [GrupoHorario21343Controller::class, 'store'])->name('grupohorarios21343.store');
Route::get('grupohorarios21343/{id}/edit', [GrupoHorario21343Controller::class, 'edit'])->name('grupohorarios21343.edit');
Route::put('grupohorarios21343/{id}', [GrupoHorario21343Controller::class, 'update'])->name('grupohorarios21343.update');
Route::delete('grupohorarios21343/{id}', [GrupoHorario21343Controller::class, 'destroy'])->name('grupohorarios21343.destroy');

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

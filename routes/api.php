<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JsonController;
use App\Http\Controllers\Json2Controller;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/deptos', [JsonController::class, 'deptos']);
Route::get('/carreras', [JsonController::class, 'carreras']);
Route::get('/semestres', [JsonController::class, 'semestres']);
Route::get('/materias', [JsonController::class, 'materias']);
Route::get('/periodos', [JsonController::class, 'periodos']);
Route::get('/personal', [JsonController::class, 'personal']);
Route::get('/edificios', [JsonController::class, 'edificios']);
Route::get('/lugar', [JsonController::class, 'lugar']);
Route::get('/grupos', [JsonController::class, 'grupos']);

Route::post('/insertar-grupo', [JsonController::class, 'insertarGrupo']);
Route::post('/insertar-grupo-horario', [JsonController::class, 'insertarGrupoHorario']);
Route::post('/eliminar-grupo-horario', [JsonController::class, 'eliminarGrupoHorario']);

/*MICHELLE*/
Route::get('/periodos', [Json2Controller::class, 'periodos']);
Route::get('/carreras', [Json2Controller::class, 'carreras']);
Route::get('/materias', [Json2Controller::class, 'materias']);
Route::get('/departamentos', [Json2Controller::class, 'departamentos']);
Route::get('/semestres', [Json2Controller::class, 'semestres']);
Route::get('/edificios', [Json2Controller::class, 'edificios']);
Route::get('/lugares', [Json2Controller::class, 'lugares']);

Route::get('/materiasAbiertasPorSemestre/{semestre}', [Json2Controller::class, 'materiasAbiertasPorSemestre']);
Route::get('/personals', [Json2Controller::class, 'personals']);

Route::post('/insertar-grupo', [Json2Controller::class, 'insertarGrupo']);

Route::post('/guardar-horario', [Json2Controller::class, 'guardarHorario']);
Route::delete('/eliminar-horario', [Json2Controller::class, 'eliminarHorario']);

Route::get('/obtener-horarios', [Json2Controller::class, 'obtenerHorarios']);
Route::get('/obtener-grupo/{grupo}', [Json2Controller::class, 'obtenerGrupo']);

Route::get('/materiasAbiertasPorCarrera/{carreraId}/semestre/{semestreId}', [JsonController::class, 'obtenerMateriasAbiertasPorCarreraSemestre']);
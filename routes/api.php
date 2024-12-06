<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JsonController;

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
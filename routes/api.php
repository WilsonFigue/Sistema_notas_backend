<?php

use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\EncargadoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Rutas de alumnos
Route::prefix('/alumnos')->group(function () {

    Route::get('/select', [AlumnosController::class, 'select']);
    Route::post('/store', [AlumnosController::class, 'store']);
    Route::put('/update/{id}', [AlumnosController::class, 'update']);
    Route::delete('/delete/{id}', [AlumnosController::class, 'delete']);
    
});

//Rutas de encargados
Route::prefix('/encargados')->group(function () {

    Route::get('/select', [EncargadoController::class, 'select']);
    Route::get('/get-encargados', [EncargadoController::class, 'getEncargados']);
    Route::post('/store', [EncargadoController::class, 'store']);
    Route::put('/update/{id}', [EncargadoController::class, 'update']);
    Route::delete('/delete/{id}', [EncargadoController::class, 'delete']);

});
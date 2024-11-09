<?php

use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\EncargadoController;
use App\Http\Controllers\GradosController;
use App\Http\Controllers\SeccionesController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->group(function () {
    
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

    //Rutas de grados
    Route::prefix('/grados')->group(function () {

        Route::get('/get-grados', [GradosController::class, 'getGrados']);

    });

    //Rutas de secciones
    Route::prefix('/secciones')->group(function () {

        Route::get('/get-secciones', [SeccionesController::class, 'getSecciones']);

    });

    
});


Route::post('/usuario/register', [UsersController::class, 'register']);
Route::post('/usuario/login', [UsersController::class, 'login']);
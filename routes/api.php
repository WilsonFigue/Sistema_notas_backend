<?php

use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\AsignacionesController;
use App\Http\Controllers\AsistenciasController;
use App\Http\Controllers\DocentesController;
use App\Http\Controllers\EncargadoController;
use App\Http\Controllers\GradosController;
use App\Http\Controllers\MateriasController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\TrimestresController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



    //Rutas de alumnos
    Route::prefix('/alumnos')->group(function () {

        Route::get('/select', [AlumnosController::class, 'select']);
        Route::post('/store', [AlumnosController::class, 'store']);
        Route::put('/update/{id}', [AlumnosController::class, 'update']);
        Route::delete('/delete/{id}', [AlumnosController::class, 'delete']);
        Route::get('/find/{id}', [AlumnosController::class, 'find']);
        Route::get('/select-alumnos/{id_docente}', [AlumnosController::class, 'selectAlumnosGrados']);
        
    });

    //Rutas de encargados
    Route::prefix('/encargados')->group(function () {

        Route::get('/select', [EncargadoController::class, 'select']);
        Route::get('/get-encargados', [EncargadoController::class, 'getEncargados']);
        Route::post('/store', [EncargadoController::class, 'store']);
        Route::put('/update/{id}', [EncargadoController::class, 'update']);
        Route::delete('/delete/{id}', [EncargadoController::class, 'delete']);
        Route::get('/find/{id}', [EncargadoController::class, 'find']);

    });

    //Rutas de docentes
    Route::prefix('/docentes')->group(function () {

        Route::get('/select', [DocentesController::class, 'select']);
        Route::get('/get-docentes', [DocentesController::class, 'getDocentes']);
        Route::post('/store', [DocentesController::class, 'store']);
        Route::put('/update/{id}', [DocentesController::class, 'update']);
        Route::delete('/delete/{id}', [DocentesController::class, 'delete']);
        Route::get('/find/{id}', [DocentesController::class, 'find']);
        
    });

    //Rutas de grados
    Route::prefix('/grados')->group(function () {

        Route::get('/select', [GradosController::class, 'select']);
        Route::get('/get-grados', [GradosController::class, 'getGrados']);

    });

     //Rutas de usuarios al loguearse 
     Route::prefix('/usuario')->group(function () {

        Route::get('/get-users', [UsersController::class, 'getUsers']);
        Route::get('/select', [UsersController::class, 'select']);
        Route::delete('/delete/{id}', [UsersController::class, 'delete']);
        Route::post('/update-password/{id}', [UsersController::class, 'updatePassword']);
    });

    //Rutas de materias 
    Route::prefix('/materias')->group(function () {

        Route::get('/get-materias', [MateriasController::class, 'getMaterias']);
        Route::get('/select-materias/{id_docente}/{id_grado}', [MateriasController::class, 'selectMateriasDocente']);
    });

     //Rutas de trimestres 
    Route::prefix('/trimestres')->group(function () {

        Route::get('/get-trimestres', [TrimestresController::class, 'getTrimestres']);
    });

    Route::prefix('/aginaciones')->group(function () {

        Route::post('/store', [AsignacionesController::class, 'store']);
        Route::get('/find/{id_grado}/{id_materia}', [AsignacionesController::class, 'find']);
        Route::put('/update/{id_asignacion}', [AsignacionesController::class, 'update']);
    });

    Route::prefix('/notas')->group(function () {

        Route::get('/find-model/{id_alumno}/{id_asignacion}/{id_trimestre}', [NotasController::class, 'findModel']);
        
        Route::post('/update-create', [NotasController::class, 'UpdateOrCreate']);
    });

//Rutas de usuarios sin loguearse 
Route::prefix('/usuario')->group(function () {

    Route::post('login', [UsersController::class, 'login']);
    Route::post('register', [UsersController::class, 'register']);

});

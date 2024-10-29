<?php

use App\Http\Controllers\AlumnosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Rutas de alumnos
Route::prefix('/alumnos')->group(function () {

    Route::get('/select', [AlumnosController::class, 'select']);
    Route::post('/store', [AlumnosController::class, 'store']);
    Route::put('/update/{id}', [AlumnosController::class, 'update']);

});
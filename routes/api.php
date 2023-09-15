<?php

use App\Http\Controllers\Alternativa_EstadoController;
use App\Http\Controllers\AlternativaController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\MaximaxController;
use App\Http\Controllers\MaximinController;
use App\Http\Controllers\ProblemaController;
use Illuminate\Support\Facades\Route;

Route::group([  'middleware' => 'api'],function(){
    //Alternativa
    Route::get('/alternativa', [AlternativaController::class, 'Consultar']);
    Route::post('/alternativa', [AlternativaController::class, 'CrearAlternativa']);
    Route::delete('/alternativa/{id}', [AlternativaController::class, 'EliminarAlternativa']);

    //Problema
    Route::get('/problema', [ProblemaController::class, 'Consultar']);
    Route::post('/problema', [ProblemaController::class, 'CrearProblema']);
    Route::delete('/problema/{id}', [ProblemaController::class, 'EliminarProblema']);

    //Estado
    Route::get('/estado', [EstadoController::class, 'Consultar']);
    Route::post('/estado', [EstadoController::class, 'CrearEstado']);
    Route::delete('/estado/{id}', [EstadoController::class, 'EliminarEstado']);

    //Alternativa estado
    Route::get('/alternativa-estado', [Alternativa_EstadoController::class, 'Consultar']);
    Route::post('/alternativa-estado', [Alternativa_EstadoController::class, 'CrearAlternativaEstado']);
    Route::delete('/alternativa-estado/{id}', [Alternativa_EstadoController::class, 'EliminarAlternativaEstado']);

    //Tabla MaxiMax
    Route::get('/MaxiMax/{parametro1}/{parametro2}',[MaximaxController::class, 'ejecutarProcedimientoAlmacenado']);

    //Tabla MaxiMax
    Route::get('/MaxiMin/{parametro1}/{parametro2}',[MaximinController::class, 'ejecutarProcedimientoAlmacenado']);
});
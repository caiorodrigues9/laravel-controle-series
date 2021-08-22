<?php

use App\Http\Controllers\EpisodiosController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadasController;
use Illuminate\Support\Facades\Route;


Route::get('/series', [
    SeriesController::class,
    'index'
])->name('listar_series');

Route::get('/series/criar', [
    SeriesController::class,
    'create'
])->name('form_criar_serie');

Route::post('/series/criar', [
    SeriesController::class,
    'store'
]);

Route::delete('/series/remover/{id}', [
    SeriesController::class,
    'destroy'
]);

Route::get('series/{serieId}/temporadas',[
    TemporadasController::class,
    'index'
]);

Route::post('/series/{id}/editaNome', [
    SeriesController::class,
    'etitaNome'
]);

Route::get('/temporadas/{temporada}/episodios', [
    EpisodiosController::class,
    'index'
]);

Route::post('/temporadas/{temporada}/episodios/assistir', [
    EpisodiosController::class,
    'assistir'
]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/entrar',[
    \App\Http\Controllers\EntrarController::class,
    'index'
])->name('entrar');

Route::post('/entrar',[
    \App\Http\Controllers\EntrarController::class,
    'entrar'
]);
Route::get('/registrar', [
    \App\Http\Controllers\RegistroController::class,
    'create'
]);
Route::post('/registrar', [
    \App\Http\Controllers\RegistroController::class,
    'store'
]);

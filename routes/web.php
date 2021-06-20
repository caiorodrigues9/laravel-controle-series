<?php

use App\Http\Controllers\SeriesController;
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


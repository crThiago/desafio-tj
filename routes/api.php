<?php

use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LivroController;
use Illuminate\Support\Facades\Route;

Route::apiResource('assunto', AssuntoController::class);
Route::apiResource('autor', AutorController::class);
Route::apiResource('livro', LivroController::class);

<?php

use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Route;

Route::apiResource('assunto', AssuntoController::class);
Route::apiResource('autor', AutorController::class);
Route::apiResource('livro', LivroController::class);
Route::get('relatorio', [RelatorioController::class, 'index'])->name('relatorio');

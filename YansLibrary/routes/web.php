<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibreriaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LibroController;

Route::get('/', [LibreriaController::class, 'inicio'])->name('inicio');

Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');

Route::get('/libros/crear', [LibroController::class, 'create'])->name('libros.create');
Route::post('/libros', [LibroController::class, 'store'])->name('libros.store');

require __DIR__.'/auth.php';
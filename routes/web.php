<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Cambia esto en tu routes/web.php:
Route::get('/dashboard', [ProfileController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas agrupadas con middleware de autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ruta temporal para el catálogo de Mari
Route::get('/products', function () {
    return "Catálogo de Productos (Módulo de Mari en construcción)";
})->name('products.index');

require __DIR__.'/auth.php';
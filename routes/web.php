<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TurnoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

    // Turnos Peluquero
    Route::patch('/turnos/{turno}/cancelar',[TurnoController::class, 'cancelarPorPeluquero'])->name('turnos.cancelar');
});


// Rutas del Cliente

// -> Turnos
Route::get('/barberias/{barberia}/turnos', [TurnoController::class, 'create']);
Route::post('/barberias/{barberia}/turnos', [TurnoController::class, 'store']);


// -> Horarios Disponibles
Route::get('/barberias/{barberia}/horarios-disponibles',[TurnoController::class, 'horariosDisponibles']);

require __DIR__.'/auth.php';

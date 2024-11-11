<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});



Route::post('ocupar', [ReservasController::class, 'ocupar'])->name('ReservasController.ocupar');
Route::post('liberar', [ReservasController::class, 'liberar'])->name('ReservasController.liberar');
Route::post('obtener', [ReservasController::class, 'obtener'])->name('ReservasController.obtener');
Route::post('actualizar', [ReservasController::class, 'actualizar'])->name('ReservasController.actualizar');
Route::post('buscarAsiento', [ReservasController::class, 'buscarAsiento'])->name('ReservasController.buscarAsiento');
Route::post('asientosOcupados', [ReservasController::class, 'asientosOcupados'])->name('ReservasController.asientosOcupados');
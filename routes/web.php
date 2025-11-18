<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TallerController;
use App\Http\Controllers\AdminController;

Route::get('/', [InicioController::class, 'index'])->name('inicio');

Auth::routes();

// CLIENTE
Route::middleware(['auth', 'rol:cliente'])->group(function () {
    Route::get('/cliente/talleres', [ClienteController::class, 'index'])->name('cliente.talleres');
    Route::get('/cliente/reservar', [ClienteController::class, 'reservar'])->name('cliente.reservar');
});

// TALLER
Route::middleware(['auth', 'rol:taller'])->group(function () {
    Route::get('/taller/reservas', [TallerController::class, 'index'])->name('taller.reservas');
});

// ADMIN
Route::middleware(['auth', 'rol:admin'])->group(function () {
    Route::get('/admin/usuarios', [AdminController::class, 'index'])->name('admin.usuarios');
});

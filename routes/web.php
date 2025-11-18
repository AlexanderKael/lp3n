<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::prefix('usuario')->name('usuario.')->group(function () {
        Route::get('/reservas', [App\Http\Controllers\UsuarioController::class, 'reservas'])->name('reservas');
        Route::get('/talleres', [App\Http\Controllers\UsuarioController::class, 'talleres'])->name('talleres');
        Route::get('/historial', [App\Http\Controllers\UsuarioController::class, 'historial'])->name('historial');
        Route::get('/notificaciones', [App\Http\Controllers\UsuarioController::class, 'notificaciones'])->name('notificaciones');
        Route::post('/notificaciones/{id}/marcar-leida', [App\Http\Controllers\UsuarioController::class, 'marcarLeida'])->name('notificaciones.marcar-leida');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/agendas', [App\Http\Controllers\AdminController::class, 'agendas'])->name('agendas');
        Route::get('/talleres', [App\Http\Controllers\AdminController::class, 'talleres'])->name('talleres');
        Route::post('/talleres', [App\Http\Controllers\AdminController::class, 'crearTaller'])->name('talleres.crear');
        Route::get('/tecnicos', [App\Http\Controllers\AdminController::class, 'tecnicos'])->name('tecnicos');
        Route::post('/tecnicos', [App\Http\Controllers\AdminController::class, 'crearTecnico'])->name('tecnicos.crear');
        Route::get('/notificaciones', [App\Http\Controllers\AdminController::class, 'notificaciones'])->name('notificaciones');
        Route::post('/notificaciones', [App\Http\Controllers\AdminController::class, 'enviarNotificacion'])->name('notificaciones.enviar');
    });
});

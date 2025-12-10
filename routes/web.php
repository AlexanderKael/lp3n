<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::prefix('tecnico')->name('tecnico.')->group(function () {
        Route::get('/', [App\Http\Controllers\TecnicoController::class, 'index'])->name('index');
        Route::get('/elegir-taller', [App\Http\Controllers\TecnicoController::class, 'elegirTaller'])->name('elegir-taller');
        Route::post('/guardar-taller', [App\Http\Controllers\TecnicoController::class, 'guardarTaller'])->name('guardar-taller');
        Route::get('/reservas-disponibles', [App\Http\Controllers\TecnicoController::class, 'reservasDisponibles'])->name('reservas-disponibles');
        Route::post('/tomar-reserva/{id}', [App\Http\Controllers\TecnicoController::class, 'tomarReserva'])->name('tomar-reserva');
        Route::get('/mis-reservas', [App\Http\Controllers\TecnicoController::class, 'misReservas'])->name('mis-reservas');
        Route::post('/cambiar-estado/{id}', [App\Http\Controllers\TecnicoController::class, 'cambiarEstado'])->name('cambiar-estado');
    });

    Route::prefix('usuario')->name('usuario.')->group(function () {
        Route::get('/reservas', [App\Http\Controllers\UsuarioController::class, 'reservas'])->name('reservas');
        Route::post('/reservas', [App\Http\Controllers\UsuarioController::class, 'crearReserva'])->name('reservas.crear');
        Route::get('/talleres', [App\Http\Controllers\UsuarioController::class, 'talleres'])->name('talleres');
        Route::get('/buscar-talleres', [App\Http\Controllers\UsuarioController::class, 'buscarTalleres'])->name('buscar-talleres');
        Route::get('/disponibilidad/{taller}/{fecha}', [App\Http\Controllers\UsuarioController::class, 'verDisponibilidad'])->name('disponibilidad');
        Route::get('/historial', [App\Http\Controllers\UsuarioController::class, 'historial'])->name('historial');
        Route::get('/cita/{id}', [App\Http\Controllers\UsuarioController::class, 'verCita'])->name('cita.ver');
        Route::get('/notificaciones', [App\Http\Controllers\UsuarioController::class, 'notificaciones'])->name('notificaciones');
        Route::post('/notificaciones/{id}/marcar-leida', [App\Http\Controllers\UsuarioController::class, 'marcarLeida'])->name('notificaciones.marcar-leida');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/agendas', [App\Http\Controllers\AdminController::class, 'agendas'])->name('agendas');
        Route::get('/talleres', [App\Http\Controllers\AdminController::class, 'talleres'])->name('talleres');
        Route::post('/talleres', [App\Http\Controllers\AdminController::class, 'crearTaller'])->name('talleres.crear');
        Route::get('/tecnicos', [App\Http\Controllers\AdminController::class, 'tecnicos'])->name('tecnicos');
        Route::get('/usuarios', [App\Http\Controllers\AdminController::class, 'usuarios'])->name('usuarios');
        Route::get('/notificaciones', [App\Http\Controllers\AdminController::class, 'notificaciones'])->name('notificaciones');
        Route::post('/notificaciones', [App\Http\Controllers\AdminController::class, 'enviarNotificacion'])->name('notificaciones.enviar');
    });
});

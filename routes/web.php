<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// PANEL USUARIO
Route::get('/talleres', function () { return view('usuario.talleres'); });
Route::get('/reservar', function () { return view('usuario.reservar'); });
Route::get('/mis-reservas', function () { return view('usuario.mis_reservas'); });
Route::get('/historial', function () { return view('usuario.historial'); });

// PANEL ADMIN
Route::get('/admin/agenda', function () { return view('admin.agenda'); });
Route::get('/admin/citas', function () { return view('admin.citas'); });
Route::get('/admin/tecnicos', function () { return view('admin.asignar_tecnicos'); });
Route::get('/admin/recordatorios', function () { return view('admin.recordatorios'); });

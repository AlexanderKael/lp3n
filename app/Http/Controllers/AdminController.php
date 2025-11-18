<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $usuarios = [
            ['nombre' => 'Carlos', 'rol' => 'cliente'],
            ['nombre' => 'Taller MotorMax', 'rol' => 'taller'],
        ];

        return view('admin.usuarios', compact('usuarios'));
    }
}

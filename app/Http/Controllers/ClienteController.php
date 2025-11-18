<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class ClienteController extends Controller
{
    public function index()
    {
        $talleres = [
            ['nombre' => 'Taller MotorMax', 'direccion' => 'Av. Lima 123', 'disponible' => true],
            ['nombre' => 'Rápido y Fino', 'direccion' => 'Calle Sol 55', 'disponible' => false],
        ];

        return view('cliente.talleres', compact('talleres'));
    }

    public function reservar()
    {
        return view('cliente.reservar');
    }
}

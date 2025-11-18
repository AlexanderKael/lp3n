<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TallerController extends Controller
{
    public function index()
    {
        $reservas = [
            ['cliente' => 'Carlos', 'fecha' => '2025-01-20', 'servicio' => 'Cambio de aceite'],
            ['cliente' => 'María', 'fecha' => '2025-01-22', 'servicio' => 'Frenos'],
        ];

        return view('taller.reservas', compact('reservas'));
    }
}

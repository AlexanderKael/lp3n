<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use App\Models\Cita;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TecnicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:tecnico');
    }

    public function index()
    {
        $user = Auth::user();
        
        if (!$user->taller_id) {
            return redirect()->route('tecnico.elegir-taller');
        }

        $taller = Taller::find($user->taller_id);
        $reservasDisponibles = Cita::where('taller_id', $user->taller_id)
            ->disponibles()
            ->count();

        $misReservas = Cita::where('tecnico_user_id', $user->id)
            ->where('estado_progreso', '!=', 'completado')
            ->count();

        return view('tecnico.index', compact('reservasDisponibles', 'misReservas', 'taller'));
    }

    public function elegirTaller()
    {
        $user = Auth::user();
        $talleres = Taller::all();
        $tallerActual = $user->taller_id ? Taller::find($user->taller_id) : null;
        
        return view('tecnico.elegir_taller', compact('talleres', 'tallerActual'));
    }

    public function guardarTaller(Request $request)
    {
        $request->validate([
            'taller_id' => 'required|exists:talleres,id',
        ]);

        $user = Auth::user();
        $tallerAnterior = $user->taller_id;
        $user->taller_id = $request->taller_id;
        $user->save();

        $mensaje = $tallerAnterior 
            ? 'Taller cambiado correctamente' 
            : 'Taller seleccionado correctamente';

        return redirect()->route('tecnico.index')->with('success', $mensaje);
    }

    public function reservasDisponibles()
    {
        $user = Auth::user();
        
        if (!$user->taller_id) {
            return redirect()->route('tecnico.elegir-taller');
        }

        $reservas = Cita::where('taller_id', $user->taller_id)
            ->disponibles()
            ->with(['user', 'taller'])
            ->orderBy('fecha', 'asc')
            ->orderBy('hora', 'asc')
            ->get();

        return view('tecnico.reservas_disponibles', compact('reservas'));
    }

    public function tomarReserva($id)
    {
        $user = Auth::user();
        
        if (!$user->taller_id) {
            return redirect()->route('tecnico.elegir-taller');
        }

        $cita = Cita::where('id', $id)
            ->where('taller_id', $user->taller_id)
            ->disponibles()
            ->firstOrFail();

        $cita->tecnico_user_id = $user->id;
        $cita->estado_progreso = 'pendiente';
        $cita->save();

        Notificacion::create([
            'user_id' => $cita->user_id,
            'titulo' => 'Reserva Asignada',
            'mensaje' => 'Un técnico ha tomado tu reserva del ' . $cita->fecha->format('d/m/Y') . ' a las ' . date('H:i', strtotime($cita->hora)),
            'leida' => false,
        ]);

        return redirect()->route('tecnico.reservas-disponibles')->with('success', 'Reserva tomada correctamente');
    }

    public function misReservas()
    {
        $user = Auth::user();
        
        $reservas = Cita::where('tecnico_user_id', $user->id)
            ->with(['user', 'taller'])
            ->orderBy('fecha', 'desc')
            ->orderBy('hora', 'desc')
            ->get();

        return view('tecnico.mis_reservas', compact('reservas'));
    }

    public function cambiarEstado(Request $request, $id)
    {
        $request->validate([
            'estado_progreso' => 'required|in:pendiente,en_proceso,completado',
        ]);

        $user = Auth::user();
        
        $cita = Cita::where('id', $id)
            ->where('tecnico_user_id', $user->id)
            ->firstOrFail();

        $estadoAnterior = $cita->estado_progreso;
        $cita->estado_progreso = $request->estado_progreso;
        $cita->save();

        $mensajes = [
            'en_proceso' => 'Tu cita ha comenzado a ser atendida',
            'completado' => 'Tu cita ha sido completada',
        ];

        if (isset($mensajes[$request->estado_progreso])) {
            Notificacion::create([
                'user_id' => $cita->user_id,
                'titulo' => 'Estado de Cita Actualizado',
                'mensaje' => $mensajes[$request->estado_progreso] . ' - Fecha: ' . $cita->fecha->format('d/m/Y') . ' a las ' . date('H:i', strtotime($cita->hora)),
                'leida' => false,
            ]);
        }

        return redirect()->route('tecnico.mis-reservas')->with('success', 'Estado actualizado correctamente');
    }
}

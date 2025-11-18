<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use App\Models\Tecnico;
use App\Models\Cita;
use App\Models\Notificacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->isAdmin()) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function agendas()
    {
        $citas = Cita::with(['taller', 'tecnico', 'user'])->get();
        return view('admin.agendas', compact('citas'));
    }

    public function talleres()
    {
        $talleres = Taller::all();
        return view('admin.talleres', compact('talleres'));
    }

    public function crearTaller(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'hora_apertura' => 'nullable|date_format:H:i',
            'hora_cierre' => 'nullable|date_format:H:i',
            'dias_atencion' => 'nullable|string',
        ]);

        Taller::create($request->all());

        return redirect()->route('admin.talleres')->with('success', 'Taller creado exitosamente');
    }

    public function tecnicos()
    {
        $talleres = Taller::all();
        $tecnicos = Tecnico::with('taller')->get();
        return view('admin.tecnicos', compact('talleres', 'tecnicos'));
    }

    public function crearTecnico(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'taller_id' => 'required|exists:talleres,id',
            'horario_disponible_inicio' => 'nullable|date_format:H:i',
            'horario_disponible_fin' => 'nullable|date_format:H:i',
            'dias_disponibles' => 'nullable|string',
        ]);

        Tecnico::create($request->all());

        return redirect()->route('admin.tecnicos')->with('success', 'Técnico creado exitosamente');
    }

    public function notificaciones()
    {
        $usuarios = User::where('role', 'usuario')->get();
        $notificaciones = Notificacion::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.notificaciones', compact('usuarios', 'notificaciones'));
    }

    public function enviarNotificacion(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'titulo' => 'required|string|max:255',
            'mensaje' => 'required|string',
        ]);

        Notificacion::create([
            'user_id' => $request->user_id,
            'titulo' => $request->titulo,
            'mensaje' => $request->mensaje,
            'leida' => false,
        ]);

        return redirect()->route('admin.notificaciones')->with('success', 'Notificación enviada exitosamente');
    }
}

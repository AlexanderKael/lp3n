<?php

namespace App\Http\Controllers;

use App\Models\Taller;
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
            $user = Auth::user();
            if (!$user || $user->role !== 'admin') {
                abort(403);
            }
            return $next($request);
        });
    }

    public function agendas()
    {
        $citas = Cita::with(['taller', 'tecnico', 'user', 'tecnicoUser'])->orderBy('fecha', 'desc')->orderBy('hora', 'desc')->get();
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
            'ciudad' => 'nullable|string|max:255',
        ]);

        Taller::create($request->all());

        return redirect()->route('admin.talleres')->with('success', 'Taller creado exitosamente');
    }

    public function tecnicos()
    {
        $tecnicos = User::where('role', 'tecnico')->with('taller')->orderBy('created_at', 'desc')->get();
        return view('admin.tecnicos', compact('tecnicos'));
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

    public function usuarios()
    {
        $usuarios = User::with('taller')->orderBy('created_at', 'desc')->get();
        return view('admin.usuarios', compact('usuarios'));
    }

    public function dashboard()
    {
        $totalTecnicos = User::where('role', 'tecnico')->count();
        $totalUsuarios = User::where('role', 'usuario')->count();
        $totalTalleres = Taller::count();
        $totalCitas = Cita::count();
        
        $tecnicos = User::where('role', 'tecnico')->with('taller')->limit(5)->get();
        $usuarios = User::where('role', 'usuario')->limit(5)->get();
        $talleres = Taller::limit(5)->get();

        return view('admin.dashboard', compact('totalTecnicos', 'totalUsuarios', 'totalTalleres', 'totalCitas', 'tecnicos', 'usuarios', 'talleres'));
    }
}

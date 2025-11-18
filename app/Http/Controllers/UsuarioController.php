<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use App\Models\Cita;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reservas()
    {
        return view('usuario.reservas');
    }

    public function talleres()
    {
        $talleres = Taller::all();
        return view('usuario.talleres', compact('talleres'));
    }

    public function historial()
    {
        $citas = Cita::where('user_id', Auth::id())
            ->with(['taller', 'tecnico'])
            ->orderBy('fecha', 'desc')
            ->get();
        return view('usuario.historial', compact('citas'));
    }

    public function notificaciones()
    {
        $notificaciones = Notificacion::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('usuario.notificaciones', compact('notificaciones'));
    }

    public function marcarLeida($id)
    {
        $notificacion = Notificacion::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        $notificacion->update(['leida' => true]);

        return redirect()->route('usuario.notificaciones')->with('success', 'Notificación marcada como leída');
    }
}

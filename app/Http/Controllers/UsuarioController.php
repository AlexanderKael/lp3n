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

    public function reservas(Request $request)
    {
        $talleres = Taller::all();
        $tallerId = $request->input('taller');
        $taller = null;
        
        if ($tallerId) {
            $taller = Taller::find($tallerId);
        }
        
        return view('usuarios.reservas', compact('talleres', 'taller'));
    }

    public function crearReserva(Request $request)
    {
        $request->validate([
            'taller_id' => 'required|exists:talleres,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'servicio' => 'required|string|max:255',
            'placa_vehiculo' => 'nullable|string|max:20',
            'descripcion' => 'nullable|string',
        ]);

        $taller = Taller::findOrFail($request->taller_id);

        if (!$taller->estaAbierto($request->fecha, $request->hora)) {
            return back()->withErrors(['hora' => 'El taller no está abierto en esa fecha y hora'])->withInput();
        }

        $existeCita = Cita::where('taller_id', $request->taller_id)
            ->where('fecha', $request->fecha)
            ->where('hora', $request->hora)
            ->exists();

        if ($existeCita) {
            return back()->withErrors(['hora' => 'Ya existe una cita en ese horario'])->withInput();
        }

        $cita = Cita::create([
            'taller_id' => $request->taller_id,
            'user_id' => Auth::id(),
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'servicio' => $request->servicio,
            'placa_vehiculo' => $request->placa_vehiculo,
            'descripcion' => $request->descripcion,
            'estado' => 'pendiente',
            'estado_progreso' => 'pendiente',
        ]);

        return redirect()->route('usuario.historial')->with('success', 'Reserva creada correctamente');
    }

    public function verDisponibilidad($taller, $fecha)
    {
        $taller = Taller::findOrFail($taller);
        $horarios = $taller->horariosDisponibles($fecha);

        return response()->json(['horarios' => $horarios]);
    }

    public function talleres()
    {
        $talleres = Taller::all();
        return view('usuario.talleres', compact('talleres'));
    }

    public function buscarTalleres(Request $request)
    {
        $ciudad = $request->input('ciudad');
        $direccion = $request->input('direccion');

        $query = Taller::query();

        if ($ciudad) {
            $query->where('ciudad', 'like', '%' . $ciudad . '%');
        }

        if ($direccion) {
            $query->where('direccion', 'like', '%' . $direccion . '%');
        }

        $talleres = $query->get();

        return view('usuarios.buscar_talleres', compact('talleres', 'ciudad', 'direccion'));
    }

    public function historial()
    {
        $citas = Cita::where('user_id', Auth::id())
            ->with(['taller', 'tecnicoUser', 'tecnico'])
            ->orderBy('fecha', 'desc')
            ->get();
        return view('usuarios.historial', compact('citas'));
    }

    public function verCita($id)
    {
        $cita = Cita::where('id', $id)
            ->where('user_id', Auth::id())
            ->with(['taller', 'tecnicoUser', 'tecnico'])
            ->firstOrFail();

        return view('usuarios.ver_cita', compact('cita'));
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #27ae60; color: white;">
                    <h4 class="mb-0">Mis Reservas</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Cliente</th>
                                    <th>Servicio</th>
                                    <th>Placa Vehículo</th>
                                    <th>Estado</th>
                                    <th>Cambiar Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reservas as $reserva)
                                    <tr>
                                        <td>{{ $reserva->fecha->format('d/m/Y') }}</td>
                                        <td>{{ date('H:i', strtotime($reserva->hora)) }}</td>
                                        <td>{{ $reserva->user->name }}</td>
                                        <td>{{ $reserva->servicio }}</td>
                                        <td>{{ $reserva->placa_vehiculo ?? 'N/A' }}</td>
                                        <td>
                                            @if($reserva->estado_progreso == 'pendiente')
                                                <span class="badge bg-warning">Pendiente</span>
                                            @elseif($reserva->estado_progreso == 'en_proceso')
                                                <span class="badge bg-info">En Proceso</span>
                                            @elseif($reserva->estado_progreso == 'completado')
                                                <span class="badge bg-success">Completado</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('tecnico.cambiar-estado', $reserva->id) }}" style="display: inline;">
                                                @csrf
                                                <select name="estado_progreso" class="form-select form-select-sm" onchange="this.form.submit()">
                                                    <option value="pendiente" {{ $reserva->estado_progreso == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                    <option value="en_proceso" {{ $reserva->estado_progreso == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                                    <option value="completado" {{ $reserva->estado_progreso == 'completado' ? 'selected' : '' }}>Completado</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No tienes reservas asignadas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


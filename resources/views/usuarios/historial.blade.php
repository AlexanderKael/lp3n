@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #3498db; color: white;">
                    <h4 class="mb-0">Historial de Citas</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Taller</th>
                                    <th>Servicio</th>
                                    <th>Placa Vehículo</th>
                                    <th>Estado</th>
                                    <th>Técnico</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($citas as $cita)
                                    <tr>
                                        <td>{{ $cita->fecha->format('d/m/Y') }}</td>
                                        <td>{{ date('H:i', strtotime($cita->hora)) }}</td>
                                        <td>{{ $cita->taller->nombre }}</td>
                                        <td>{{ $cita->servicio }}</td>
                                        <td>{{ $cita->placa_vehiculo ?? 'N/A' }}</td>
                                        <td>
                                            @if($cita->estado_progreso == 'pendiente')
                                                <span class="badge bg-warning">Pendiente</span>
                                            @elseif($cita->estado_progreso == 'en_proceso')
                                                <span class="badge bg-info">En Proceso</span>
                                            @elseif($cita->estado_progreso == 'completado')
                                                <span class="badge bg-success">Completado</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($cita->tecnicoUser)
                                                {{ $cita->tecnicoUser->name }}
                                            @elseif($cita->tecnico)
                                                {{ $cita->tecnico->nombre }}
                                            @else
                                                Sin asignar
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('usuario.cita.ver', $cita->id) }}" class="btn btn-sm btn-primary">Ver Detalles</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No tienes citas registradas</td>
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


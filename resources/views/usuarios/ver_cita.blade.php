@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #3498db; color: white;">
                    <h4 class="mb-0">Detalles de la Cita</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Fecha:</strong> {{ $cita->fecha->format('d/m/Y') }}
                    </div>
                    <div class="mb-3">
                        <strong>Hora:</strong> {{ date('H:i', strtotime($cita->hora)) }}
                    </div>
                    <div class="mb-3">
                        <strong>Taller:</strong> {{ $cita->taller->nombre }}
                    </div>
                    <div class="mb-3">
                        <strong>Dirección:</strong> {{ $cita->taller->direccion }}
                    </div>
                    <div class="mb-3">
                        <strong>Teléfono:</strong> {{ $cita->taller->telefono }}
                    </div>
                    <div class="mb-3">
                        <strong>Servicio:</strong> {{ $cita->servicio }}
                    </div>
                    @if($cita->placa_vehiculo)
                        <div class="mb-3">
                            <strong>Placa del Vehículo:</strong> {{ $cita->placa_vehiculo }}
                        </div>
                    @endif
                    @if($cita->descripcion)
                        <div class="mb-3">
                            <strong>Descripción:</strong> {{ $cita->descripcion }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <strong>Estado:</strong>
                        @if($cita->estado_progreso == 'pendiente')
                            <span class="badge bg-warning">Pendiente</span>
                        @elseif($cita->estado_progreso == 'en_proceso')
                            <span class="badge bg-info">En Proceso</span>
                        @elseif($cita->estado_progreso == 'completado')
                            <span class="badge bg-success">Completado</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <strong>Técnico Asignado:</strong>
                        @if($cita->tecnicoUser)
                            {{ $cita->tecnicoUser->name }}
                        @elseif($cita->tecnico)
                            {{ $cita->tecnico->nombre }}
                        @else
                            Sin asignar
                        @endif
                    </div>
                    <a href="{{ route('usuario.historial') }}" class="btn btn-secondary">Volver al Historial</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





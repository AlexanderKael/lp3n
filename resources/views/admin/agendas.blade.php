@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #e74c3c; color: white;">
                    <h4 class="mb-0">Gestión de Agendas</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Cliente</th>
                                    <th>Servicio</th>
                                    <th>Estado</th>
                                    <th>Técnico</th>
                                    <th>Taller</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($citas as $cita)
                                    <tr>
                                        <td>{{ $cita->fecha->format('Y-m-d') }}</td>
                                        <td>{{ date('H:i', strtotime($cita->hora)) }}</td>
                                        <td>{{ $cita->user->name }}</td>
                                        <td>{{ $cita->servicio }}</td>
                                        <td>
                                            @if($cita->estado == 'pendiente')
                                                <span class="badge bg-warning">Pendiente</span>
                                            @elseif($cita->estado == 'confirmada')
                                                <span class="badge bg-success">Confirmada</span>
                                            @elseif($cita->estado == 'cancelada')
                                                <span class="badge bg-danger">Cancelada</span>
                                            @else
                                                <span class="badge bg-info">{{ $cita->estado }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $cita->tecnico->nombre ?? 'Sin asignar' }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $cita->taller->nombre }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No hay citas registradas</td>
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


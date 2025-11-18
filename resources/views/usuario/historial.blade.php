@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #3498db; color: white;">
                    <h4 class="mb-0">Historial de Reservas y Citas</h4>
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
                                    <th>Estado</th>
                                    <th>Técnico</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($citas as $cita)
                                    <tr>
                                        <td>{{ $cita->fecha->format('Y-m-d') }}</td>
                                        <td>{{ date('H:i', strtotime($cita->hora)) }}</td>
                                        <td>{{ $cita->taller->nombre }}</td>
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
                                        <td>{{ $cita->tecnico->nombre ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No tienes citas registradas</td>
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


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #27ae60; color: white;">
                    <h4 class="mb-0">Reservas Disponibles</h4>
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
                                    <th>Acción</th>
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
                                            <form method="POST" action="{{ route('tecnico.tomar-reserva', $reserva->id) }}" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm" style="background-color: #27ae60; color: white;">Tomar Reserva</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No hay reservas disponibles</td>
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





@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-header" style="background-color: #27ae60; color: white;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Dashboard Técnico</h4>
                        <a href="{{ route('tecnico.elegir-taller') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-building"></i> Cambiar Taller
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-3">
                        <strong>Taller asignado:</strong> {{ $taller->nombre }} - {{ $taller->direccion }}
                        @if($taller->ciudad)
                            <br><small>{{ $taller->ciudad }}</small>
                        @endif
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card text-center" style="background-color: #3498db; color: white;">
                                <div class="card-body">
                                    <h5 class="card-title">Reservas Disponibles</h5>
                                    <h2 class="card-text">{{ $reservasDisponibles }}</h2>
                                    <a href="{{ route('tecnico.reservas-disponibles') }}" class="btn btn-light">Ver Reservas</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-center" style="background-color: #e67e22; color: white;">
                                <div class="card-body">
                                    <h5 class="card-title">Mis Reservas Activas</h5>
                                    <h2 class="card-text">{{ $misReservas }}</h2>
                                    <a href="{{ route('tecnico.mis-reservas') }}" class="btn btn-light">Ver Mis Reservas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


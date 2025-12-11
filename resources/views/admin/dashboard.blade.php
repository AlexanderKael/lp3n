@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="mb-4">Dashboard Administrativo</h2>
            
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-center" style="background-color: #3498db; color: white;">
                        <div class="card-body">
                            <h5 class="card-title">Técnicos</h5>
                            <h2 class="card-text">{{ $totalTecnicos }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center" style="background-color: #2ecc71; color: white;">
                        <div class="card-body">
                            <h5 class="card-title">Usuarios</h5>
                            <h2 class="card-text">{{ $totalUsuarios }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center" style="background-color: #e67e22; color: white;">
                        <div class="card-body">
                            <h5 class="card-title">Talleres</h5>
                            <h2 class="card-text">{{ $totalTalleres }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center" style="background-color: #9b59b6; color: white;">
                        <div class="card-body">
                            <h5 class="card-title">Citas</h5>
                            <h2 class="card-text">{{ $totalCitas }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header" style="background-color: #e74c3c; color: white;">
                            <h5 class="mb-0">Técnicos Recientes</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @forelse($tecnicos as $tecnico)
                                    <li class="list-group-item">
                                        {{ $tecnico->name }} - {{ $tecnico->taller->nombre ?? 'Sin taller' }}
                                    </li>
                                @empty
                                    <li class="list-group-item">No hay técnicos</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header" style="background-color: #e74c3c; color: white;">
                            <h5 class="mb-0">Usuarios Recientes</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @forelse($usuarios as $usuario)
                                    <li class="list-group-item">
                                        {{ $usuario->name }} - {{ $usuario->email }}
                                    </li>
                                @empty
                                    <li class="list-group-item">No hay usuarios</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header" style="background-color: #e74c3c; color: white;">
                            <h5 class="mb-0">Talleres</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @forelse($talleres as $taller)
                                    <li class="list-group-item">
                                        {{ $taller->nombre }} - {{ $taller->ciudad ?? 'N/A' }}
                                    </li>
                                @empty
                                    <li class="list-group-item">No hay talleres</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





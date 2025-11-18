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
                <div class="card-header" style="background-color: #e74c3c; color: white;">
                    <h4 class="mb-0">Crear Nuevo Técnico</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.tecnicos.crear') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Especialidad</label>
                                    <input type="text" class="form-control" name="especialidad" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Taller</label>
                                    <select class="form-select" name="taller_id" required>
                                        <option value="">Seleccionar taller</option>
                                        @foreach($talleres as $taller)
                                            <option value="{{ $taller->id }}">{{ $taller->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Horario Disponible Inicio</label>
                                    <input type="time" class="form-control" name="horario_disponible_inicio">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Horario Disponible Fin</label>
                                    <input type="time" class="form-control" name="horario_disponible_fin">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Días Disponibles</label>
                                    <input type="text" class="form-control" name="dias_disponibles" placeholder="Ej: Lunes, Martes, Miércoles">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn" style="background-color: #e74c3c; color: white;">Crear Técnico</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header" style="background-color: #e74c3c; color: white;">
                    <h4 class="mb-0">Lista de Técnicos</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Especialidad</th>
                                    <th>Taller</th>
                                    <th>Horario Disponible</th>
                                    <th>Días Disponibles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tecnicos as $tecnico)
                                    <tr>
                                        <td>{{ $tecnico->nombre }}</td>
                                        <td>{{ $tecnico->especialidad }}</td>
                                        <td>{{ $tecnico->taller->nombre ?? 'N/A' }}</td>
                                        <td>
                                            @if($tecnico->horario_disponible_inicio && $tecnico->horario_disponible_fin)
                                                {{ date('H:i', strtotime($tecnico->horario_disponible_inicio)) }} - {{ date('H:i', strtotime($tecnico->horario_disponible_fin)) }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $tecnico->dias_disponibles ?? 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No hay técnicos registrados</td>
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


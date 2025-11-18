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
                    <h4 class="mb-0">Registrar Nuevo Taller</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.talleres.crear') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Dirección</label>
                                    <input type="text" class="form-control" name="direccion" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" name="telefono" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Hora de Apertura</label>
                                    <input type="time" class="form-control" name="hora_apertura">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Hora de Cierre</label>
                                    <input type="time" class="form-control" name="hora_cierre">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Días de Atención</label>
                                    <input type="text" class="form-control" name="dias_atencion" placeholder="Ej: Lunes a Viernes">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn" style="background-color: #e74c3c; color: white;">Registrar Taller</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header" style="background-color: #e74c3c; color: white;">
                    <h4 class="mb-0">Lista de Talleres</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Horario de Atención</th>
                                    <th>Días de Atención</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($talleres as $taller)
                                    <tr>
                                        <td>{{ $taller->nombre }}</td>
                                        <td>{{ $taller->direccion }}</td>
                                        <td>{{ $taller->telefono }}</td>
                                        <td>{{ $taller->email }}</td>
                                        <td>
                                            @if($taller->hora_apertura && $taller->hora_cierre)
                                                {{ date('H:i', strtotime($taller->hora_apertura)) }} - {{ date('H:i', strtotime($taller->hora_cierre)) }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $taller->dias_atencion ?? 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No hay talleres registrados</td>
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


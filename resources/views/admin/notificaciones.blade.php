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
                    <h4 class="mb-0">Enviar Notificación</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.notificaciones.enviar') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Usuario</label>
                                    <select class="form-select" name="user_id" required>
                                        <option value="">Seleccionar usuario</option>
                                        @foreach($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}">{{ $usuario->name }} ({{ $usuario->email }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Título</label>
                                    <input type="text" class="form-control" name="titulo" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mensaje</label>
                            <textarea class="form-control" name="mensaje" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn" style="background-color: #e74c3c; color: white;">Enviar Notificación</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header" style="background-color: #e74c3c; color: white;">
                    <h4 class="mb-0">Historial de Notificaciones</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Título</th>
                                    <th>Mensaje</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notificaciones as $notificacion)
                                    <tr>
                                        <td>{{ $notificacion->user->name }}</td>
                                        <td>{{ $notificacion->titulo }}</td>
                                        <td>{{ Str::limit($notificacion->mensaje, 50) }}</td>
                                        <td>
                                            @if($notificacion->leida)
                                                <span class="badge bg-success">Leída</span>
                                            @else
                                                <span class="badge bg-warning">No leída</span>
                                            @endif
                                        </td>
                                        <td>{{ $notificacion->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No hay notificaciones enviadas</td>
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


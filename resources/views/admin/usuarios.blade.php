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
            <div class="card">
                <div class="card-header" style="background-color: #e74c3c; color: white;">
                    <h4 class="mb-0">Lista de Usuarios</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Taller</th>
                                    <th>Fecha Registro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>
                                            @if($usuario->role == 'admin')
                                                <span class="badge bg-danger">Administrador</span>
                                            @elseif($usuario->role == 'tecnico')
                                                <span class="badge bg-warning">Técnico</span>
                                            @else
                                                <span class="badge bg-primary">Usuario</span>
                                            @endif
                                        </td>
                                        <td>{{ $usuario->taller->nombre ?? 'Sin taller asignado' }}</td>
                                        <td>{{ $usuario->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No hay usuarios registrados</td>
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


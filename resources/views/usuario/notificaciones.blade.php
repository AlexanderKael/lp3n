@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header" style="background-color: #3498db; color: white;">
                    <h4 class="mb-0">Mis Notificaciones</h4>
                </div>
                <div class="card-body">
                    @forelse($notificaciones as $notificacion)
                        <div class="card mb-3 {{ $notificacion->leida ? '' : 'border-primary' }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title">
                                            {{ $notificacion->titulo }}
                                            @if(!$notificacion->leida)
                                                <span class="badge bg-primary">Nueva</span>
                                            @endif
                                        </h5>
                                        <p class="card-text">{{ $notificacion->mensaje }}</p>
                                        <small class="text-muted">{{ $notificacion->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                    @if(!$notificacion->leida)
                                        <form method="POST" action="{{ route('usuario.notificaciones.marcar-leida', $notificacion->id) }}" class="ms-3">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Marcar como leída</button>
                                        </form>
                                    @else
                                        <span class="badge bg-success ms-3">Leída</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info">
                            No tienes notificaciones.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


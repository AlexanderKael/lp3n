@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #3498db; color: white;">
                    <h4 class="mb-0">Buscar Talleres</h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('usuario.buscar-talleres') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Ciudad</label>
                                <input type="text" name="ciudad" class="form-control" value="{{ $ciudad ?? '' }}" placeholder="Ej: Lima">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Dirección</label>
                                <input type="text" name="direccion" class="form-control" value="{{ $direccion ?? '' }}" placeholder="Ej: Av. Principal 123">
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn" style="background-color: #3498db; color: white;">Buscar</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Ciudad</th>
                                    <th>Teléfono</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($talleres as $taller)
                                    <tr>
                                        <td>{{ $taller->nombre }}</td>
                                        <td>{{ $taller->direccion }}</td>
                                        <td>{{ $taller->ciudad ?? 'N/A' }}</td>
                                        <td>{{ $taller->telefono }}</td>
                                        <td>
                                            <a href="{{ route('usuario.reservas', ['taller' => $taller->id]) }}" class="btn btn-sm btn-primary">Reservar</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No se encontraron talleres</td>
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


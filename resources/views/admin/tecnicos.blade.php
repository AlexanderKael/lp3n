@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                                    <th>Email</th>
                                    <th>Taller</th>
                                    <th>Fecha Registro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tecnicos as $tecnico)
                                    <tr>
                                        <td>{{ $tecnico->name }}</td>
                                        <td>{{ $tecnico->email }}</td>
                                        <td>{{ $tecnico->taller->nombre ?? 'Sin taller asignado' }}</td>
                                        <td>{{ $tecnico->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No hay técnicos registrados</td>
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


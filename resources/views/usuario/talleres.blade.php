@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #3498db; color: white;">
                    <h4 class="mb-0">Talleres Disponibles</h4>
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
                                        <td colspan="6" class="text-center">No hay talleres disponibles</td>
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


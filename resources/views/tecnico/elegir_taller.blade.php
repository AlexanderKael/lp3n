@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #27ae60; color: white;">
                    <h4 class="mb-0">Elegir Taller</h4>
                </div>
                <div class="card-body">
                    @if($tallerActual)
                        <div class="alert alert-info mb-3">
                            <strong>Taller actual:</strong> {{ $tallerActual->nombre }} - {{ $tallerActual->direccion }}
                        </div>
                        <p>Puedes cambiar de taller seleccionando uno diferente:</p>
                    @else
                        <p>Por favor selecciona el taller en el que trabajarás:</p>
                    @endif
                    <form method="POST" action="{{ route('tecnico.guardar-taller') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Taller</label>
                            <select name="taller_id" class="form-select" required>
                                <option value="">Selecciona un taller</option>
                                @foreach($talleres as $taller)
                                    <option value="{{ $taller->id }}" {{ $tallerActual && $tallerActual->id == $taller->id ? 'selected' : '' }}>
                                        {{ $taller->nombre }} - {{ $taller->direccion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn" style="background-color: #27ae60; color: white;">
                            {{ $tallerActual ? 'Cambiar Taller' : 'Guardar' }}
                        </button>
                        @if($tallerActual)
                            <a href="{{ route('tecnico.index') }}" class="btn btn-secondary">Cancelar</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


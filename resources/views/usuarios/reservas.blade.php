@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #3498db; color: white;">
                    <h4 class="mb-0">Reservar Cita</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('usuario.reservas.crear') }}">
                        @csrf
                        
                        @if($taller)
                            <div class="alert alert-info mb-4">
                                <h5 class="mb-2"><strong>Taller Seleccionado:</strong> {{ $taller->nombre }}</h5>
                                <p class="mb-1"><strong>Dirección:</strong> {{ $taller->direccion }}</p>
                                @if($taller->ciudad)
                                    <p class="mb-1"><strong>Ciudad:</strong> {{ $taller->ciudad }}</p>
                                @endif
                                @if($taller->hora_apertura && $taller->hora_cierre)
                                    <p class="mb-1"><strong>Horario de Atención:</strong> {{ date('H:i', strtotime($taller->hora_apertura)) }} - {{ date('H:i', strtotime($taller->hora_cierre)) }}</p>
                                @endif
                                @if($taller->dias_atencion)
                                    <p class="mb-0"><strong>Días Disponibles:</strong> {{ $taller->dias_atencion }}</p>
                                @endif
                            </div>
                            <input type="hidden" name="taller_id" id="taller_id" value="{{ $taller->id }}">
                        @else
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Taller</label>
                                    <select name="taller_id" id="taller_id" class="form-select" required>
                                        <option value="">Selecciona un taller</option>
                                        @foreach($talleres as $tallerOption)
                                            <option value="{{ $tallerOption->id }}" {{ old('taller_id') == $tallerOption->id ? 'selected' : '' }}>{{ $tallerOption->nombre }} - {{ $tallerOption->direccion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Fecha</label>
                                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}" min="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Hora</label>
                                <select name="hora" id="hora" class="form-select" required>
                                    <option value="">Primero selecciona fecha</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Servicio</label>
                                <select name="servicio" class="form-select" required>
                                    <option value="">Selecciona un servicio</option>
                                    <option value="Mantenimiento" {{ old('servicio') == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                                    <option value="Reparación" {{ old('servicio') == 'Reparación' ? 'selected' : '' }}>Reparación</option>
                                    <option value="Diagnóstico" {{ old('servicio') == 'Diagnóstico' ? 'selected' : '' }}>Diagnóstico</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Placa del Vehículo</label>
                                <input type="text" name="placa_vehiculo" class="form-control" value="{{ old('placa_vehiculo') }}" placeholder="ABC-123">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Descripción (opcional)</label>
                                <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn" style="background-color: #3498db; color: white;">Confirmar Reserva</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="taller-data" data-taller-id="{{ $taller ? $taller->id : '' }}" style="display: none;"></div>

<script>
var tallerIdFijo = document.getElementById('taller-data')?.dataset.tallerId || null;
if (tallerIdFijo) {
    tallerIdFijo = parseInt(tallerIdFijo);
}

document.getElementById('fecha').addEventListener('change', function() {
    cargarHorarios();
});

if (!tallerIdFijo) {
    var tallerSelect = document.getElementById('taller_id');
    if (tallerSelect) {
        tallerSelect.addEventListener('change', function() {
            cargarHorarios();
        });
    }
}

function cargarHorarios() {
    var tallerId = tallerIdFijo || (document.getElementById('taller_id') ? document.getElementById('taller_id').value : null);
    var fecha = document.getElementById('fecha').value;
    const horaSelect = document.getElementById('hora');

    if (!tallerId || !fecha) {
        horaSelect.innerHTML = '<option value="">Primero selecciona fecha</option>';
        return;
    }

    fetch(`{{ url('/usuario/disponibilidad') }}/${tallerId}/${fecha}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            horaSelect.innerHTML = '<option value="">Selecciona una hora</option>';
            if (data.horarios && data.horarios.length > 0) {
                data.horarios.forEach(hora => {
                    const option = document.createElement('option');
                    option.value = hora;
                    option.textContent = hora;
                    horaSelect.appendChild(option);
                });
            } else {
                horaSelect.innerHTML = '<option value="">No hay horarios disponibles para esta fecha. Verifica que el taller tenga horarios configurados y que la fecha esté en los días de atención.</option>';
            }
        })
        .catch(error => {
            console.error('Error al cargar horarios:', error);
            horaSelect.innerHTML = '<option value="">Error al cargar horarios. Por favor, intenta de nuevo.</option>';
        });
}
</script>
@endsection


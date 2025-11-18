@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #3498db; color: white;">
                    <h4 class="mb-0">Reservas y Citas</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Taller</label>
                                <select class="form-select">
                                    <option>Seleccionar taller</option>
                                    <option>Taller Mecánico ABC</option>
                                    <option>AutoService XYZ</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Fecha</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Hora</label>
                                <input type="time" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Servicio</label>
                                <select class="form-select">
                                    <option>Mantenimiento</option>
                                    <option>Reparación</option>
                                    <option>Diagnóstico</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn" style="background-color: #3498db; color: white;">Reservar Cita</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


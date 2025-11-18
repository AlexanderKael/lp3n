@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #e74c3c; color: white;">
                    <h4 class="mb-0">Enviar Recordatorios</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Citas Próximas</h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Cliente</th>
                                            <th>Email</th>
                                            <th>Servicio</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2025-11-20</td>
                                            <td>10:00</td>
                                            <td>Juan Pérez</td>
                                            <td>juan@email.com</td>
                                            <td>Mantenimiento</td>
                                            <td><button class="btn btn-sm" style="background-color: #e74c3c; color: white;">Enviar Recordatorio</button></td>
                                        </tr>
                                        <tr>
                                            <td>2025-11-20</td>
                                            <td>14:30</td>
                                            <td>María García</td>
                                            <td>maria@email.com</td>
                                            <td>Reparación</td>
                                            <td><button class="btn btn-sm" style="background-color: #e74c3c; color: white;">Enviar Recordatorio</button></td>
                                        </tr>
                                        <tr>
                                            <td>2025-11-21</td>
                                            <td>09:00</td>
                                            <td>Pedro López</td>
                                            <td>pedro@email.com</td>
                                            <td>Diagnóstico</td>
                                            <td><button class="btn btn-sm" style="background-color: #e74c3c; color: white;">Enviar Recordatorio</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Enviar Recordatorio Masivo</h5>
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Citas del día</label>
                                    <input type="date" class="form-control">
                                </div>
                                <button type="submit" class="btn" style="background-color: #e74c3c; color: white;">Enviar a Todos</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


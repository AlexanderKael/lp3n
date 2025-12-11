@extends('layouts.app')

@section('content')

<div class="hero-section">
    <div class="hero-overlay"></div> 
    
    <div class="container py-5 hero-content" style="display: flex; align-items: center; justify-content: center; min-height: 100vh; padding-top: 100px !important; padding-bottom: 100px !important;">
        <div class="row justify-content-center w-100">
            <div class="col-lg-10 col-xl-8">
                
                <div class="card card-registro-dividido shadow border-0">
                    <div class="row g-0">
                        
                        <div class="col-md-7 p-4 p-md-5">
                            <h4 class="mb-4 fw-bold" style="color: var(--color-secondary);">
                                <i class="fas fa-user-plus me-2"></i> {{ __('CREAR CUENTA') }}
                            </h4>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold" style="color: var(--color-secondary);">Nombre Completo *</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold" style="color: var(--color-secondary);">Email *</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold" style="color: var(--color-secondary);">Contraseña *</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password-confirm" class="form-label fw-bold" style="color: var(--color-secondary);">Confirmar Contraseña *</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                                
                                <div class="mb-4">
                                    <label for="role" class="form-label fw-bold" style="color: var(--color-secondary);">Tipo de Usuario</label>
                                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role">
                                        <option value="usuario">Usuario (Por Defecto)</option>
                                        <option value="tecnico">Técnico</option>
                                        <option value="admin">Administrador</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-lg btn-primary-link fw-bold" style="border-radius: 8px;">
                                        <i class="fas fa-check-circle me-2"></i> {{ __('REGISTRARME') }}
                                    </button>
                                </div>
                                
                                <div class="text-center mt-3">
                                    <a class="btn btn-link p-0 text-decoration-none" style="color: var(--color-secondary);" href="{{ route('login') }}">
                                        {{ __('¿Ya tienes cuenta? Inicia Sesión') }}
                                    </a>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-5 d-none d-md-block register-image-side">
                            <div class="overlay-content">
                                <i class="fas fa-car-side fa-3x mb-3" style="color: white;"></i>
                                <h5 class="fw-bold mb-3 text-white">¡Únete a la Red TallerLink!</h5>
                                <p class="text-white-50">
                                    Agenda tus servicios de forma rápida, lleva el historial de tu vehículo y recibe notificaciones importantes.
                                </p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* VARIABLES DE COLOR Y ESTILOS BASE */
    :root {
        --color-primary: #3498db; 
        --color-secondary: #1f3a5f;
        --color-dark-blue: #1f3a5f;
    }
    
    /* ESTILOS DE LA TARJETA PRINCIPAL */
    .card-registro-dividido {
        border-radius: 12px; 
        overflow: hidden;
    }

    /* ESTILOS DE LA COLUMNA DE IMAGEN */
    .register-image-side {
        background: url('{{ asset('images/taller-link-background.jpg') }}') no-repeat center center;
        background-size: cover;
        position: relative;
        padding: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .register-image-side::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(52, 152, 219, 0.7); /* Overlay azul semi-transparente */
        z-index: 1;
    }
    .register-image-side .overlay-content {
        position: relative;
        z-index: 2;
    }
    /* Estilos para que el texto sea blanco y legible */
    .register-image-side .text-white-50 {
        color: rgba(255, 255, 255, 0.7) !important;
    }

    /* ESTILOS DEL BOTÓN PRINCIPAL (Copiado del Login) */
    .btn-primary-link {
        background-color: var(--color-primary); 
        border-color: var(--color-primary);
        color: white;
        padding: 12px 30px; 
        font-size: 1.1rem; 
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4); 
        transition: all 0.3s ease; 
    }
    .btn-primary-link:hover {
        background-color: #2980b9; 
        border-color: #2980b9;
        transform: translateY(-2px); 
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.5);
    }

    /* ESTILOS DE LOS INPUTS Y SELECT */
    .form-control:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
    }

    /* ESTILOS DE BOTÓN OUTLINE (por si lo necesitas en el futuro) */
    .btn-outline-secondary {
        border-color: #ccc;
        color: var(--color-secondary);
    }
    .btn-outline-secondary:hover {
        background-color: var(--color-secondary);
        color: white;
    }

</style>
@endpush
@endsection
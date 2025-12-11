@extends('layouts.app')

@section('content')

<div class="hero-section">
    <div class="hero-overlay"></div> 
    
    <div class="container py-5 hero-content" style="display: flex; align-items: center; justify-content: center; min-height: 100vh; padding-top: 100px !important; padding-bottom: 100px !important;">
        <div class="row justify-content-center w-100">
            <div class="col-lg-10 col-xl-8">
                
                <div class="card shadow border-0" style="border-radius: 12px; overflow: hidden;">
                    <div class="row g-0">
                        
                        <div class="col-md-7 p-4 p-md-5">
                            <h4 class="mb-4 fw-bold" style="color: var(--color-secondary);">
                                <i class="fas fa-lock me-2"></i> INICIAR SESIÓN
                            </h4>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold" style="color: var(--color-secondary);">Email *</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="form-label fw-bold" style="color: var(--color-secondary);">Contraseña *</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label text-muted" for="remember">
                                            {{ __('Recordar') }}
                                        </label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link p-0 text-decoration-none" style="color: var(--color-primary);" href="{{ route('password.request') }}">
                                            {{ __('¿Olvidaste tu contraseña?') }}
                                        </a>
                                    @endif
                                </div>

                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-lg btn-primary-link fw-bold" style="border-radius: 8px;">
                                        <i class="fas fa-sign-in-alt me-2"></i> {{ __('ACCEDER') }}
                                    </button>
                                </div>
                                </form>
                        </div>

                        <div class="col-md-5 d-none d-md-block" style="background-color: #f8f9fa; padding: 40px; border-left: 1px solid #eee;">
                            <div class="h-100 d-flex flex-column justify-content-center align-items-start">
                                <h5 class="fw-bold mb-3" style="color: var(--color-primary);">¿Aún no eres usuario?</h5>
                                
                                <p class="text-muted">
                                    Regístrate ahora para agendar citas, ver el historial de tu vehículo y recibir notificaciones.
                                </p>
                                
                                <a href="{{ route('register') }}" class="btn btn-outline-secondary mt-3" style="border-radius: 50px;">
                                    <i class="fas fa-user-plus me-2"></i> Crear Cuenta
                                </a>
                                
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
    :root {
        --color-primary: #3498db; 
        --color-secondary: #1f3a5f;
    }
    
    .btn-primary-link {
        padding: 12px 30px; /* Tamaño consistente y grande */
        font-size: 1.1rem; /* Un poco más grande para destacar */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4); /* Sombra más fuerte y visible */
        transition: all 0.3s ease; /* Habilitar animación suave */
    }
    .btn-primary-link:hover {
        background-color: #2980b9; 
        border-color: #2980b9;
        transform: translateY(-2px); /* Elevar el botón al pasar el ratón */
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.5); /* Sombra más intensa al elevarse */
    }

    .form-control:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
    }
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
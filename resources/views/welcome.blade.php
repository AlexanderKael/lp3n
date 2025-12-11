<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TallerLink - Conecta tu servicio automotriz</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        :root {
            --color-primary: #3498db;
            --color-secondary: #1f3a5f; 
        }

        
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
            
            background: url('/images/fondo-taller.jpg') no-repeat center center/cover;
            overflow: hidden; 
        }
        
        
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            
            background: linear-gradient(135deg, rgba(31, 58, 95, 0.7) 10%, rgba(44, 62, 80, 0.5) 50%, rgba(52, 152, 219, 0.4) 100%);
        }

        
        .hero-content {
            position: relative; 
            z-index: 10;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); 
        }

        .btn-primary-link {
            background-color: var(--color-primary); 
            border-color: var(--color-primary);
            color: white;
            padding: 12px 30px;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 50px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); 
            transition: all 0.3s ease;
        }
        .btn-primary-link:hover {
            background-color: #2980b9; 
            border-color: #2980b9;
            transform: translateY(-2px); 
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
        }


        
        .navbar {
            
            background-color: var(--color-secondary) !important; 
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
        }
        .navbar-brand {
            color: var(--color-primary) !important; 
        }
        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8); 
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: white; 
        }
    </style>

</head>
<body>
    <div id="app">
        
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    TallerLink
                </a>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item ms-3">
                                    <a class="btn btn-sm btn-primary-link" style="padding: 5px 15px; font-size: 0.9rem;" href="{{ route('register') }}">Regístrate</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item ms-3">
                                <a class="btn btn-sm btn-primary-link" style="padding: 5px 15px; font-size: 0.9rem;" href="{{ url('/home') }}">Ir a mi Panel</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        
        <header class="hero-section">
            <div class="hero-overlay"></div> 
            
            <div class="container hero-content">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h1 class="display-3 fw-bold mb-4">
                            TallerLink: Agenda, gestiona y repara tu vehículo sin complicaciones.
                        </h1>
                        <p class="lead mb-5">
                            La plataforma líder para conectar dueños de vehículos con la red de talleres más confiable.
                        </p>
                        
                        <div class="mt-4">
                            @guest
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-lg btn-primary-link">
                                        ¡Quiero reservar mi cita!
                                    </a>
                                @endif
                            @else
                                <a href="{{ url('/home') }}" class="btn btn-lg btn-primary-link">Ir a tu Panel de Control</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </header>

    </div>
</body>
</html>
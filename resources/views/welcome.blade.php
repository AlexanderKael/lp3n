<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TallerLink</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; flex-direction: column;">
            <h1>TallerLink</h1>
            
            <div style="margin-top: 30px;">
                @guest
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" style="margin-right: 10px;">Registrarse</a>
                    @endif
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}">Iniciar Sesión</a>
                    @endif
                @else
                    <a href="{{ url('/home') }}">Ir al Dashboard</a>
                @endguest
            </div>
        </div>
    </div>
</body>
</html>

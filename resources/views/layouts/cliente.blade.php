<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Estilos personalizados para el admin --}}
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #0A2640;
            color: white;
        }

        .navbar {
            background-color: #001F33;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            margin-right: 20px;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .navbar a:hover,
        .navbar a.active {
            color: #00ff88;
            text-decoration: none;
        }

        .main-content {
            padding: 30px;
        }

        .cards {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }

        .card {
            background-color: #007BFF;
            flex: 1;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="navbar-left" style="display: flex; align-items: center;">
            <!-- Ícono mancuerna como acceso a home -->
            <a href="{{ route('admin.home') }}" style="margin-right: 30px;" title="Inicio">
                <img src="{{ asset('images/mancuerna.png') }}" alt="Inicio" style="width: 50px; height: 50px;">
            </a>

            <!-- Navegación -->
            <a href="{{ route('cliente.membresias') }}" class="{{ request()->is('admin/membresia') ? 'active' : '' }}">Membresía</a>
            <a href="#" class="{{ request()->is('admin/suplementos') ? 'active' : '' }}">Suplementos</a>
            <a href="#" class="{{ request()->is('admin/spinning') ? 'active' : '' }}">Spinning</a>
            
        </div>

        <div class="navbar-right">
            <a 
            href="#" 
            class="{{ request()->routeIs('admin.profile.*') ? 'active' : '' }}"
            style="color:white; text-decoration:none; font-weight:bold;"
            >
            {{ Auth::user()->name ?? Auth::user()->emailUsu }} 🟢
            </a>
        </div>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

</body>
</html>

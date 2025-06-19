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

        /* ————— Dropdown de usuario ————— */
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropbtn {
            background: none;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
            font-size: 1rem;
            text-transform: lowercase;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #001F33;
            min-width: 160px;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
            z-index: 1000;
        }
        .dropdown-content a,
        .dropdown-content form button {
            display: block;
            width: 100%;
            padding: 12px 16px;
            background: none;
            border: none;
            color: white;
            text-align: left;
            text-transform: lowercase;
            cursor: pointer;
        }
        .dropdown-content a:hover,
        .dropdown-content form button:hover {
            background-color: #00ff88;
            color: #001F33;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown:hover .dropbtn {
            color: #00ff88;
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
            <a href="{{ route('admin.membresia') }}" class="{{ request()->is('admin/membresia') ? 'active' : '' }}">Membresía</a>
            <a href="{{ route('admin.suplementos') }}" class="{{ request()->is('admin/suplementos') ? 'active' : '' }}">Suplementos</a>
            <a href="{{ route('admin.spinning') }}" class="{{ request()->is('admin/spinning') ? 'active' : '' }}">Spinning</a>
            <a href="{{ route('admin.configuracion') }}" class="{{ request()->is('admin/configuracion') ? 'active' : '' }}">Configuración</a>
        </div>

        <div class="navbar-right">
            <div class="dropdown">
                <button class="dropbtn">
                    {{ Auth::user()->name ?? Auth::user()->emailUsu }} ⌄
                </button>
                <div class="dropdown-content">
                    <a href="{{ route('admin.perfil') }}">perfil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">cerrar sersion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

</body>
</html>

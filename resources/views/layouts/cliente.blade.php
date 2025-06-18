<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tus estilos existentes… --}}
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

        /* —————– Dropdown de usuario —————– */
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
            min-width: 180px;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            z-index: 1000;
        }
        .dropdown-content a,
        .dropdown-content form button {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
            text-transform: lowercase;
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
            <a href="{{ route('cliente.home') }}" title="Inicio">
                <img src="{{ asset('images/mancuerna.png') }}" alt="Inicio" style="width: 50px; height: 50px;">
            </a>
            <a href="{{ route('cliente.carrito') }}" title="Carrito">
                <img src="{{ asset('images/cart.png') }}" alt="Carrito" style="width: 50px; height: 50px;">
            </a>

            <a href="{{ route('cliente.membresias') }}" class="{{ request()->routeIs('cliente.membresias') ? 'active' : '' }}">Membresía</a>
            <a href="{{ route('cliente.suplementos') }}" class="{{ request()->routeIs('cliente.suplementos') ? 'active' : '' }}">Suplementos</a>
            <a href="{{ route('cliente.spinning') }}" class="{{ request()->routeIs('cliente.spinning') ? 'active' : '' }}">Spinning</a>
        </div>

        <div class="navbar-right">
            <div class="dropdown">
                <button class="dropbtn">
                    {{ Auth::user()->name ?? Auth::user()->emailUsu }} 🟢
                </button>
                <div class="dropdown-content">
                    <a href="{{ route('cliente.perfil') }}">perfil</a>
                    <a href="{{ route('cliente.facturas') }}">ver facturas</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">cerrar sesión</button>
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

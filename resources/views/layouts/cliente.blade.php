<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ALPHA CLIENTE</title>
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
            flex-wrap: wrap; 
        }
        .navbar-left {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }
        .navbar-left a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .navbar-left img {
            width: 50px;
            height: 50px;
            margin: 0 10px;
            max-width: 100%;
            height: auto;
        }
        .navbar a:hover,
        .navbar a.active {
            color: #00ff88;
            text-decoration: none;
        }

        
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

        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
                padding: 10px;
            }
            .navbar-left, .navbar-right {
                width: 100%;
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
            }
            .navbar-left a,
            .navbar-left img {
                margin: 5px;
            }
            .dropbtn {
                font-size: 0.9rem;
            }
            .dropdown-content {
                right: 10px;
                left: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="navbar-left">
            <!-- Ícono mancuerna como acceso a home -->
            <a href="{{ route('cliente.home') }}" title="Inicio">
                <img src="{{ asset('images/mancuerna.png') }}" alt="Inicio">
            </a>
            <a href="{{ route('cliente.carrito') }}" title="Carrito">
                <img src="{{ asset('images/cart.png') }}" alt="Carrito">
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

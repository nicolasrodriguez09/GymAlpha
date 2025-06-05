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
        }

        .navbar a:hover {
            text-decoration: underline;
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
        <div class="navbar-left">
            <a href="#">🏋️ Membresía</a>
            <a href="#">Suplementos</a>
            <a href="#">Spinning</a>
            <a href="#">Configuración</a>
        </div>
        <div class="navbar-right">
            <span>Administrador 🟢</span>
        </div>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

</body>
</html>

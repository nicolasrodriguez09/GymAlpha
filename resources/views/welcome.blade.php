<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GymAlpha</title>

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Aquí tu Tailwind preflight si no usas Vite -->
    @endif
</head>
<body class="bg-[#022339] text-white font-sans antialiased">

    {{-- Navbar --}}
    <nav class="flex justify-between items-center p-6">
        <div class="flex items-center">
            <img src="{{ asset('images/mancuerna.png') }}" class="h-10 w-10 mr-3" alt="GymAlpha">
            <span class="text-2xl font-bold">GymAlpha</span>
        </div>
        <div class="space-x-4">
            @auth
                <a href="{{ route('cliente.home') }}" class="hover:text-green-400">Panel Cliente</a>
            @else
                <a href="{{ route('login') }}" class="inline-block bg-green-500 hover:bg-green-600 text-black font-medium py-2 px-4 rounded transition">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-block bg-green-500 hover:bg-green-600 text-black font-medium py-2 px-4 rounded transition">Register</a>
                @endif
            @endauth
        </div>
    </nav>

    {{-- Hero con fondo --}}
    <header 
        class="relative h-screen bg-cover bg-center" 
        style="background-image: url('{{ asset('images/welcome.png') }}')"
    >
        <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col justify-center items-center text-center px-4">
            <h1 class="text-5xl font-bold mb-4">Bienvenido a GymAlpha</h1>
            <p class="text-xl mb-6">Tu fitness, nuestra pasión. ¡Únete y alcanza tus metas hoy!</p>
            @auth
                <a href="{{ route('cliente.home') }}" class="bg-green-500 hover:bg-green-600 px-8 py-3 rounded text-lg">
                    Ir al panel
                </a>
            @else
                <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 px-8 py-3 rounded text-lg">
                    Comenzar
                </a>
            @endauth
        </div>
    </header>

    {{-- Servicios --}}
    <section class="py-16 bg-[#022339] text-center">
        <h2 class="text-3xl font-bold mb-12">Nuestros Servicios</h2>
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
            <div class="bg-[#024f71] p-6 rounded-lg flex flex-col items-center">
                <img 
                    src="{{ asset('images/membership.png') }}" 
                    alt="Membresías" 
                    class="h-32 w-32 object-cover rounded-full mb-4"
                >
                <h3 class="text-2xl font-semibold mb-2">Membresías</h3>
                <p>Accede a todas nuestras instalaciones y servicios ilimitados.</p>
            </div>
            <div class="bg-[#024f71] p-6 rounded-lg flex flex-col items-center">
                <img 
                    src="{{ asset('images/suplements.png') }}" 
                    alt="Suplementos" 
                    class="h-32 w-32 object-cover rounded-full mb-4"
                >
                <h3 class="text-2xl font-semibold mb-2">Suplementos</h3>
                <p>Encuentra el complemento perfecto para tu entrenamiento.</p>
            </div>
            <div class="bg-[#024f71] p-6 rounded-lg flex flex-col items-center">
                <img 
                    src="{{ asset('images/bicicleta.png') }}" 
                    alt="Spinning" 
                    class="h-32 w-32 object-cover rounded-full mb-4"
                >
                <h3 class="text-2xl font-semibold mb-2">Spinning</h3>
                <p>Reserva clases de spinning energéticas con nuestros instructores.</p>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-[#012f4b] py-6 text-center text-gray-300">
        &copy; {{ date('Y') }} GymAlpha. Todos los derechos reservados.
    </footer>

</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>{{ config('app.name', 'Gym Alpha') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">

  {{-- Contenedor principal: ocupa toda la pantalla, fondo #023859 --}}
  <div class="min-h-screen flex flex-col bg-[#023859]">

    {{-- =====================================================
         1) Cabecera fija con logo + texto centrados
         ===================================================== --}}
    <div class="w-full max-w-4xl mx-auto px-4 sm:px-0 py-6 flex justify-center items-center">
      {{-- Logo de Laravel a la izquierda del texto --}}
      <a href="{{ url('/') }}" class="block mr-3">
        {{-- Tamaño sugerido: w-16 h-16 (4rem × 4rem) --}}
        <x-application-logo class="w-16 h-16 text-gray-300 hover:text-gray-100 transition-colors" />
      </a>
      {{-- Texto “Bienvenido a Gym Alpha” centrado --}}
      <h1 class="text-white text-2xl sm:text-3xl font-bold">
        Bienvenido a Gym Alpha
      </h1>
    </div>

    {{-- =====================================================
         2) Espacio central donde se inyecta el login
         ===================================================== --}}
    <div class="flex-1 flex items-center justify-center px-4 sm:px-0">
      {{-- Aquí se inyecta el contenido de login.blade.php --}}
      {{ $slot }}
    </div>

  </div>
</body>
</html>

@extends('layouts.admin')

@section('content')
<div style="display: flex; gap: 40px; align-items: flex-start;">
    <!-- Columna izquierda -->
    <div style="flex: 1;">
        <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 20px;">Bienvenido al Gym</h1>

        <div style="display: flex; align-items: center; margin-bottom: 15px;">
            <img src="{{ asset('images/cart.png') }}" alt="Carrito" style="width: 32px; height: 32px; margin-right: 10px;">
            <span style="font-size: 1.1rem;"></span>
        </div>

        <h3 style="margin-bottom: 20px;">
            Gestiona tus pagos, suplementos, entrenadores y clases desde un solo lugar.
        </h3>

        <p style="font-size: 0.9rem; color: #ccc;">
            En GymAlpha nos enfocamos en ofrecerte una experiencia completa para tu bienestar físico.<br><br>
            Desde la gestión de tus membresías hasta el acceso a suplementos de calidad y clases especializadas, todo está al alcance de un clic.<br><br>
            Contamos con entrenadores certificados, rutinas personalizadas y una plataforma intuitiva para que alcances tus objetivos de manera eficaz y segura.<br>
            
        </p>
    </div>

    <!-- Columna derecha -->
    <div style="width: 460px;">
        
        <img src="{{ asset('images/suplemento.png') }}" alt="Suplemento" style="width: 70%; border-radius: 10px; margin-bottom: 10px;">
            
    </div>
</div>
@endsection

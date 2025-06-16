@extends('layouts.cliente')

@section('content')
<style>
    .container {
        display: flex;
        height: 100vh;
    }

    .form-section {
        flex: 1;
        background-color: #013a54;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 40px;
    }

    .form-section h1 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 30px;
        text-align: left;
    }

    .form-section h3 {
        font-size: 1.3rem;
        margin-bottom: 20px;
    }

    .info-icon {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .info-icon img {
        width: 32px;
        height: 32px;
        margin-right: 10px;
    }

    .form-section p {
        font-size: 0.95rem;
        color: #ccc;
        line-height: 1.6;
    }

    .image-section {
        flex: 1;
        background-color: #002d72;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
    }

    .image-section img {
        width: auto;
        max-height: 90%;
        max-width: 100%;
        object-fit: contain;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
    }
</style>

<div class="container">
    <!-- Sección de bienvenida -->
    <div class="form-section">
        <h1>Bienvenido al Gym</h1>

        <div class="info-icon">
            <img src="{{ asset('images/cart.png') }}" alt="Carrito">
            <span style="font-size: 1.1rem;">Gestiona tus pagos, suplementos, entrenadores y clases desde un solo lugar.</span>
        </div>

        <h3>
            En GymAlpha nos enfocamos en ofrecerte una experiencia completa para tu bienestar físico.
        </h3>

        <p>
            Desde la gestión de tus membresías hasta el acceso a suplementos de calidad y clases especializadas, todo está al alcance de un clic.<br><br>
            Contamos con entrenadores certificados, rutinas personalizadas y una plataforma intuitiva para que alcances tus objetivos de manera eficaz y segura.
        </p>
    </div>

    <!-- Imagen -->
    <div class="image-section">
        <img src="{{ asset('images/suplemento.png') }}" alt="Imagen suplementos">
    </div>
</div>
@endsection
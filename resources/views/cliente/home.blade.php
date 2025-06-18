@extends('layouts.cliente')

@section('content')
<style>
    .container {
        display: flex;
        height: 100vh;
        margin: 0;
        padding: 0;
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
        text-align: center;
    }

    .form-section h2 {
        font-size: 1.3rem;
        margin-bottom: 20px;
    }

    .form-section p {
        font-size: 0.95rem;
        color: #ccc;
        line-height: 1.6;
    }

    .image-section {
        flex: 1;
        background-color: #013a54;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-section img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Responsive para móviles/tabletas */
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
            height: auto;
        }
        .form-section,
        .image-section {
            width: 100%;
            padding: 20px;
        }
        .image-section {
            height: 200px; /* ajustable */
        }
        .form-section h1 {
            font-size: 2rem;
        }
        .form-section h2 {
            font-size: 1.1rem;
        }
    }
</style>

<div class="container">
    <!-- Sección de bienvenida (izquierda en desktop) -->
    <div class="form-section">
        <h1>¡Bienvenido a GymAlpha!</h1>
        <h2>
            Tu entrenamiento, tus suplementos y tus clases… <br>todo en un solo lugar.
        </h2>
        <p>
            Elige tu plan de membresía, compra suplementos de calidad y reserva tus clases en segundos, sin complicaciones. <br>
            Empieza hoy y entrena a tu ritmo.
        </p>
    </div>

    <!-- Imagen (derecha en desktop) -->
    <div class="image-section">
        <img src="{{ asset('images/home.png') }}" alt="Imagen suplementos">
    </div>
</div>
@endsection

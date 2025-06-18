@extends('layouts.admin')

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
        
    }

    .image-section img {
        width: 100%;
        height: 100%;
        max-height: 100%;
        max-width: 100%;
        object-fit: cover;
        border-radius: 0px;
        
    }
</style>

<div class="container">
    <!-- Sección de bienvenida -->
    <div class="form-section">
        <h1>Bienvenido al panel jefe!</h1>

        

        <h3>
            administra y gestiona todo entorno a tu gym
        </h3>

        
    </div>

    <!-- Imagen -->
    <div class="image-section">
        <img src="{{ asset('images/panelAdmin.png') }}" alt="Imagen suplementos">
    </div>
</div>
@endsection

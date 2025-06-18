@extends('layouts.admin')

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
        align-items: center;
        padding: 40px;
    }

    .form-section h2 {
        font-size: 2.4rem;
        font-weight: bold;
        margin-bottom: 30px;
        text-align: center;
    }

    .action-row {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .action-row img {
        width: 40px;
        height: 40px;
        margin-right: 15px;
    }

    .action-button {
        background-color: #007BFF;
        color: white;
        border: none;
        padding: 12px 24px;
        font-size: 1rem;
        width: 240px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-decoration: none;
        text-align: center;
    }

    .action-button:hover {
        background-color: #00c853;
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
    <!-- Sección izquierda -->
    <div class="form-section">
        <h2>Tipo de documento</h2>

        @php
            $acciones = [
                ['label' => 'Agregar tipo de documento', 'icon' => 'add.png', 'route' => route('admin.configuracion.agregarTipo')],
                ['label' => 'Eliminar tipo de documento', 'icon' => 'delete.png', 'route' => route('admin.configuracion.eliminarTipo')],
                ['label' => 'Modificar tipo de documento', 'icon' => 'edit.png', 'route' => route('admin.configuracion.modificarTipo')],
                ['label' => 'Consultar tipo de documento', 'icon' => 'edit.png', 'route' => route('admin.configuracion.consultarTipo')],
            ];
        @endphp

        @foreach ($acciones as $accion)
            <div class="action-row">
                <img src="{{ asset('images/' . $accion['icon']) }}" alt="icono">
                <a href="{{ $accion['route'] }}" class="action-button">
                    {{ $accion['label'] }}
                </a>
            </div>
        @endforeach
    </div>

    <!-- Sección derecha -->
    <div class="image-section">
        <img src="{{ asset('images/configuracion.png') }}" alt="Imagen suplementos">
    </div>
</div>
@endsection

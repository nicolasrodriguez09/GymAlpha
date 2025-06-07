@extends('layouts.admin')

@section('content')
<style>
    .responsive-container {
        display: flex;
        gap: 40px;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .left-column, .right-column {
        flex: 1 1 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .left-inner {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 25px;
        width: 100%;
        max-width: 500px;
    }

    .left-inner h2 {
        font-size: 2.4rem;
        font-weight: bold;
        margin-bottom: 10px;
        text-align: center;
    }

    .action-row {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
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
        width: 170px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-decoration: none;
        text-align: center;
    }

    .action-button:hover {
        background-color: #00ff88;
    }

    .right-column img {
        width: 100%;
        max-width: 600px;
        height: auto;
        object-fit: cover;
        border-radius: 8px;
    }

    @media (min-width: 768px) {
        .left-column, .right-column {
            flex: 1 1 50%;
        }

        .responsive-container {
            flex-wrap: nowrap;
        }

        .left-inner h2 {
            font-size: 2.8rem;
        }

        .action-button {
            font-size: 1.1rem;
            width: 200px;
        }
    }

    @media (max-width: 480px) {
        .action-button {
            font-size: 0.95rem;
            padding: 10px 20px;
            width: 160px;
        }

        .action-row img {
            width: 32px;
            height: 32px;
        }
    }
</style>

<div class="responsive-container">
    <!-- Columna izquierda -->
    <div class="left-column">
        <div class="left-inner">
            <h2>Proveedor</h2>

            @php
                $acciones = [
                    ['label' => 'Agregar proveedor', 'icon' => 'add.png', 'route' => route('admin.configuracion.agregarProveedor')],
                    ['label' => 'Eliminar proveedor', 'icon' => 'delete.png', 'route' => route('admin.configuracion.eliminarProveedor')],
                    ['label' => 'Modificar proveedor', 'icon' => 'edit.png', 'route' => route('admin.configuracion.modificarProveedor')],
                    ['label' => 'Consultar proveedor', 'icon' => 'edit.png', 'route' => route('admin.configuracion.consultarProveedor')],
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
    </div>

    <!-- Columna derecha -->
    <div class="right-column">
        <img src="{{ asset('images/suplemento.png') }}" alt="Imagen suplementos">
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div style="display: flex; gap: 40px; align-items: flex-start;">
    <!-- Columna izquierda centrada -->
    <div style="flex: 1; display: flex; align-items: center; justify-content: center;">
        <div style="display: flex; flex-direction: column; align-items: center; gap: 25px;">
            <h2 style="font-size: 2.8rem; font-weight: bold; margin-bottom: 10px;">Configuracion</h2>

            @php
                $acciones = [
                    ['label' => 'Permisos de Admin', 'icon' => 'add.png', 'route' => route('admin.configuracion.permisos')],
                    ['label' => 'Categoria de Producto', 'icon' => 'delete.png', 'route' => route('admin.configuracion.categoriaProducto')],
                    ['label' => 'Forma de Pago', 'icon' => 'edit.png', 'route' => route('admin.configuracion.formaPago')],
                    ['label' => 'Inventario', 'icon' => 'search.png', 'route' => route('admin.configuracion.inventario')],
                    ['label' => 'Tipo de Documento', 'icon' => 'search.png', 'route' => route('admin.configuracion.tipoDocumento')],
                    ['label' => 'Proveedor', 'icon' => 'search.png', 'route' => route('admin.configuracion.proveedor')],
                ];
            @endphp

            @foreach ($acciones as $accion)
            <div style="display: flex; align-items: center;">
                <img src="{{ asset('images/' . $accion['icon']) }}" alt="icono" style="width: 40px; height: 40px; margin-right: 15px;">
                <a  style="
                    background-color: #007BFF;
                    color: white;
                    border: none;
                    padding: 12px 24px;
                    width: 170px;
                    text-align: center;
                    font-size: 1rem;
                    border-radius: 6px;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                    text-decoration: none;
                "
                onmouseover="this.style.backgroundColor='#00ff88'"
                onmouseout="this.style.backgroundColor='#007BFF'">
                    {{ $accion['label'] }}
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Columna derecha: imagen ocupa todo el alto -->
    <div style="flex: 1;">
        <img src="{{ asset('images/suplemento.png') }}" alt="Imagen suplementos" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
</div>
@endsection

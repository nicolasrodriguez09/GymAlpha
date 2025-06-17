@extends('layouts.cliente')

@section('content')
<style>
    .container { display: flex; justify-content: center; padding: 40px; }
    .card {
        background-color: #013a54;
        color: white;
        border-radius: 12px;
        padding: 30px;
        max-width: 600px;
        width: 100%;
        box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    }
    .card h2 {
        font-size: 2rem;
        color: #00c853;
        margin-bottom: 20px;
        text-transform: lowercase;
    }
    .card p {
        margin-bottom: 12px;
        line-height: 1.4;
    }
    .label { font-weight: bold; text-transform: lowercase; }
</style>

<div class="container">
    <div class="card">
        <h2>factura de membresía</h2>

        <p><span class="label">cliente:</span> {{ $factura->usuario->name }}</p>
        <p><span class="label">membresía:</span> {{ $factura->membresia->nombreMembresia }}</p>
        <p><span class="label">descripción:</span> {{ $factura->membresia->descripcionMembresia }}</p>
        <p><span class="label">precio:</span> ${{ number_format($factura->membresia->precioMembresia, 2) }}</p>
        <p><span class="label">forma de pago:</span> {{ $factura->formaPago->nombreBanco }}
            @if($factura->formaPago->numeroCuenta) - {{ $factura->formaPago->numeroCuenta }} @endif
        </p>
        <p><span class="label">fecha de compra:</span> {{ \Carbon\Carbon::parse($factura->fechaCompra)->format('d/m/Y H:i') }}</p>

        <div style="margin-top: 30px; text-align: right;">
            <a href="{{ route('cliente.carrito') }}" style="color: #00c853; text-decoration: none; text-transform: lowercase;">
                ← volver al carrito
            </a>
        </div>
    </div>
</div>
@endsection

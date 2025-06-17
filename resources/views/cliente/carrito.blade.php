@extends('layouts.cliente')

@section('content')
<style>
    .container { display: flex; min-height: 100vh; }
    .form-section {
        flex: 1;
        background-color: #013a54;
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px;
    }
    .form-section h2 {
        font-size: 2.2rem;
        font-weight: bold;
        margin-bottom: 20px;
        text-transform: lowercase;
    }
    table {
        width: 100%;
        max-width: 600px;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    table th, table td {
        padding: 10px;
        border: 1px solid #ffffff33;
    }
    table th {
        background-color: #004080;
        color: white;
        text-transform: lowercase;
        text-align: center;
    }
    table td {
        background-color: #001e31;
        color: white;
        vertical-align: middle;
    }
    table td.actions {
        text-align: center;
        width: 160px;
    }
    .quantity-btn {
        background-color: #00c853;
        color: white;
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 4px;
        cursor: pointer;
        margin: 0 2px;
    }
    .total-row td {
        border: none;
        padding-top: 20px;
        text-transform: lowercase;
        font-weight: bold;
    }

    /* Nuevo contenedor para alinear select + botones */
    .action-buttons {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-top: 20px;
    }

    /* Formulario de checkout y clear como flex-items */
    .action-buttons form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .submit-btn, .empty-btn {
        padding: 12px 40px;
        font-size: 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        color: white;
        text-transform: lowercase;
        min-width: 120px;
        text-align: center;
    }
    .submit-btn {
        background-color: #00c853;
    }
    .empty-btn {
        background-color: #ff4444;
    }

    label {
        margin: 0;
        text-transform: lowercase;
        white-space: nowrap;
    }
    select {
        padding: 6px;
        border-radius: 4px;
        border: 1px solid #ffffff33;
        background-color: #001e31;
        color: white;
        position: relative;
        z-index: 1000;
    }
</style>

<div class="container">
    <div class="form-section">
        <h2>Carrito de compras</h2>

        @if(session('success'))
            <div style="color: #00ff88; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cart) > 0)
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $key => $item)
                        <tr>
                            <td>{{ $item['nombre'] }}</td>
                            <td>${{ number_format($item['precio'], 2) }}</td>
                            <td>{{ $item['cantidad'] }}</td>
                            <td class="actions">
                                <form action="{{ route('cliente.carrito.decrement', $key) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="quantity-btn">-</button>
                                </form>
                                <form action="{{ route('cliente.carrito.increment', $key) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="quantity-btn">+</button>
                                </form>
                                <form action="{{ route('cliente.carrito.remove', $key) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="quantity-btn">x</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="3">Total:</td>
                        <td>${{ number_format($total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>

            <div class="action-buttons">
                <!-- Checkout -->
                <form method="POST" action="{{ route('cliente.carrito.checkout') }}">
                    @csrf
                    <label for="forma_pago">forma de pago:</label>
                    <select id="forma_pago" name="forma_pago" required>
                        <option value="">Selecciona un método</option>
                        @forelse($formas as $forma)
                            <option value="{{ $forma->idFormaPago }}">
                                {{ $forma->nombreBanco }}
                                @if($forma->numeroCuenta) - {{ $forma->numeroCuenta }} @endif
                            </option>
                        @empty
                            <option value="">-- Sin métodos disponibles --</option>
                        @endforelse
                    </select>
                    <button type="submit" class="submit-btn">pagar</button>
                </form>

                <!-- Vaciar carrito -->
                <form action="{{ route('cliente.carrito.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="empty-btn">vaciar carrito</button>
                </form>
            </div>

        @else
            <p>No hay productos en el carrito.</p>
        @endif

        @if(isset($factura))
            <div style="margin-top: 30px; background-color: #002244; padding: 20px; border-radius: 10px;">
                <h2 style="color: #00c853; font-size: 1.8rem; margin-bottom: 15px;">factura de membresía</h2>
                <p><strong>cliente:</strong> {{ $factura->usuario->name }}</p>
                <p><strong>membresía:</strong> {{ $factura->membresia->nombreMembresia }}</p>
                <p><strong>descripción:</strong> {{ $factura->membresia->descripcionMembresia }}</p>
                <p><strong>precio:</strong> ${{ number_format($factura->membresia->precioMembresia, 2) }}</p>
                <p><strong>forma de pago:</strong> {{ $factura->formaPago->nombreBanco }}
                   @if($factura->formaPago->numeroCuenta) - {{ $factura->formaPago->numeroCuenta }} @endif
                </p>
                <p><strong>fecha:</strong> {{ \Carbon\Carbon::parse($factura->fechaCompra)->format('d/m/Y H:i') }}</p>
            </div>
        @endif
    </div>
</div>
@endsection

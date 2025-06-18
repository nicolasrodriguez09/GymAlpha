@extends('layouts.cliente')

@section('content')
<style>
    .container {
        display: flex;
        min-height: 100vh;
    }
    .form-section {
        flex: 1;
        background-color: #013a54;
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px;
        box-sizing: border-box;
    }
    .form-section h2 {
        font-size: 2.2rem;
        font-weight: bold;
        margin-bottom: 20px;
        text-transform: lowercase;
        text-align: center;
    }
    .table-wrapper {
        width: 100%;
        max-width: 600px;
        overflow-x: auto;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }
    table th, table td {
        padding: 10px;
        border: 1px solid #ffffff33;
        text-transform: lowercase;
    }
    table th {
        background-color: #004080;
        color: white;
        text-align: center;
    }
    table td {
        background-color: #001e31;
        vertical-align: middle;
        color: white;
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
        font-weight: bold;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-top: 20px;
    }
    .action-buttons form {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .submit-btn,
    .empty-btn {
        padding: 12px 40px;
        font-size: 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        color: white;
        text-transform: lowercase;
        min-width: 120px;
        text-align: center;
        transition: background-color 0.2s;
    }
    .submit-btn {
        background-color: #00c853;
    }
    .submit-btn:hover {
        background-color: #00b24a;
    }
    .empty-btn {
        background-color: #ff4444;
    }
    .empty-btn:hover {
        background-color: #e63939;
    }
    label {
        margin: 0;
        white-space: nowrap;
        text-transform: lowercase;
    }
    select {
        padding: 6px;
        border-radius: 4px;
        border: 1px solid #ffffff33;
        background-color: #001e31;
        color: white;
    }

    /* —— Responsive Tablets (≤1024px) —— */
    @media (max-width: 1024px) {
        .form-section {
            padding: 30px;
        }
        table th, table td {
            padding: 8px;
        }
        .action-buttons {
            gap: 15px;
        }
    }

    /* —— Responsive Móviles (≤768px) —— */
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
            min-height: auto;
        }
        .form-section {
            width: 100%;
            padding: 20px;
        }
        .table-wrapper {
            max-width: 100%;
        }
        table {
            min-width: 100%;
        }
        .action-buttons {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }
        .action-buttons form {
            width: 100%;
            justify-content: space-between;
        }
        .submit-btn,
        .empty-btn {
            width: 100%;
            max-width: none;
        }
    }
</style>

<div class="container">
    <div class="form-section">
        <h2>carrito de compras</h2>

        @if(session('success'))
            <div style="color: #00ff88; margin-bottom: 15px; text-transform: lowercase;">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>producto</th>
                            <th>precio</th>
                            <th>cantidad</th>
                            <th>acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $key => $item)
                            <tr>
                                <td>{{ $item['nombre'] }}</td>
                                <td>${{ number_format($item['precio'], 2) }}</td>
                                <td>{{ $item['cantidad'] }}</td>
                                <td class="actions">
                                    <form action="{{ route('cliente.carrito.decrement', $key) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="quantity-btn">-</button>
                                    </form>
                                    <form action="{{ route('cliente.carrito.increment', $key) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="quantity-btn">+</button>
                                    </form>
                                    <form action="{{ route('cliente.carrito.remove', $key) }}" method="POST">
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
                            <td colspan="3">total:</td>
                            <td>${{ number_format($total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="action-buttons">
                <form method="POST" action="{{ route('cliente.carrito.checkout') }}">
                    @csrf
                    <label for="forma_pago">forma de pago:</label>
                    <select id="forma_pago" name="forma_pago" required>
                        <option value="">selecciona un método</option>
                        @forelse($formas as $forma)
                            <option value="{{ $forma->idFormaPago }}">
                                {{ $forma->nombreBanco }}
                                @if($forma->numeroCuenta) - {{ $forma->numeroCuenta }} @endif
                            </option>
                        @empty
                            <option value="">-- sin métodos disponibles --</option>
                        @endforelse
                    </select>
                    <button type="submit" class="submit-btn">pagar</button>
                </form>

                <form action="{{ route('cliente.carrito.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="empty-btn">vaciar carrito</button>
                </form>
            </div>
        @else
            <p style="text-transform: lowercase;">no hay productos en el carrito.</p>
        @endif

        @isset($factura)
            <div style="margin-top: 30px; background-color: #002244; padding: 20px; border-radius: 10px;">
                <h2 style="color: #00c853; font-size: 1.8rem; margin-bottom: 15px; text-transform: lowercase;">
                    factura de membresía
                </h2>
                <p><strong>cliente:</strong> {{ $factura->usuario->name }}</p>
                <p><strong>membresía:</strong> {{ $factura->membresia->nombreMembresia }}</p>
                <p><strong>descripción:</strong> {{ $factura->membresia->descripcionMembresia }}</p>
                <p><strong>precio:</strong> ${{ number_format($factura->membresia->precioMembresia, 2) }}</p>
                <p><strong>forma de pago:</strong> {{ $factura->formaPago->nombreBanco }}
                   @if($factura->formaPago->numeroCuenta) - {{ $factura->formaPago->numeroCuenta }} @endif
                </p>
                <p><strong>fecha:</strong> {{ \Carbon\Carbon::parse($factura->fechaCompra)->format('d/m/Y H:i') }}</p>
            </div>
        @endisset
    </div>
</div>
@endsection

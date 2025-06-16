
@extends('layouts.cliente')

@section('content')
<style>
    .container { display: flex; height: 100vh; }
    .form-section {
        flex: 1;
        background-color: #013a54;
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px;
        overflow-y: auto;
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
        width: 100px;
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
    .button-group {
        display: flex;
        gap: 40px;
        margin-top: 10px;
    }
    .submit-btn {
        background-color: #00c853;
        padding: 12px 50px;
        font-size: 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        color: white;
        text-transform: lowercase;
    }
    .image-section {
        flex: 1;
        background-color: #002d72;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .image-section img {
        max-height: 90%;
        object-fit: contain;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    }
</style>

<div class="container">
    <div class="form-section">
        <h2>carrito de compras</h2>

        @if(session('success'))
            <div style="background-color: #00c853; color: white; padding: 10px 20px; border-radius: 6px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @if($cart->isEmpty())
            <p style="text-transform: lowercase;">tu carrito está vacío.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>producto</th>
                        <th>cantidad</th>
                        <th>precio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $key => $item)
                    <tr>
                        <td style="text-transform: lowercase;">{{ $item['nombre'] }}</td>
                        <td style="text-align: center;">{{ $item['cantidad'] }}</td>
                        <td style="text-align: right;">${{ number_format($item['precio'],0,',','.') }}</td>
                        <td class="actions">
                            <form action="{{ route('cliente.carrito.increment', ['key' => $key]) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="quantity-btn">+</button>
                            </form>
                            <form action="{{ route('cliente.carrito.decrement', ['key' => $key]) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="quantity-btn">-</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="2" style="text-align: left;">valor total:</td>
                        <td colspan="2" style="text-align: right;">${{ number_format($total,0,',','.') }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="button-group">
                <form action="{{ route('cliente.carrito.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="submit-btn">pagar</button>
                </form>
                <form action="{{ route('cliente.carrito.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="submit-btn">eliminar</button>
                </form>
            </div>
        @endif
    </div>

    <div class="image-section">
        {{-- <img src="{{ asset('images/carrito.png') }}" alt="Carrito de Compras"> --}}
    </div>
</div>
@endsection

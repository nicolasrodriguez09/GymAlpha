@extends('cliente.layout')

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
        justify-content: flex-start;
        padding: 40px;
        overflow-y: auto;
    }
    .form-section h2 {
        font-size: 2.2rem; font-weight: bold; margin-bottom: 20px;
    }
    .product-card {
        background-color: #001e31; border-radius: 8px; padding: 20px; margin-bottom: 20px;
        width: 100%; max-width: 400px; color: white;
    }
    .product-card h3 { margin-bottom: 10px; }
    .product-card p { font-size: 0.9rem; margin-bottom: 10px; }
    .product-card .price { font-weight: bold; margin-bottom: 10px; }
    .submit-btn {
        background-color: #00c853; padding: 12px 30px;
        font-size: 1rem; border: none; border-radius: 8px;
        cursor: pointer; color: white;
    }
    .image-section {
        flex: 1; background-color: #002d72;
        display: flex; justify-content: center; align-items: center;
        padding: 0;
    }
    .image-section img {
        max-height: 90%; object-fit: contain;
        border-radius: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    }
</style>

<div class="container">
    <div class="form-section">
        <h2>Suplementos disponibles</h2>

        @foreach($suplementos as $s)
        <div class="product-card">
            <h3>{{ $s->nombreSuplemento }}</h3>
            <p>{{ Str::limit($s->descripcionSuplemento, 100) }}</p>
            <div class="price">${{ number_format($s->precioSuplemento,2) }}</div>
            <form action="{{ route('cliente.carrito.addSuplemento') }}" method="POST">
                @csrf
                <input type="hidden" name="suplemento_id" value="{{ $s->idSuplemento }}">
                <button type="submit" class="submit-btn">Agregar al carrito</button>
            </form>
        </div>
        @endforeach

    </div>

    <div class="image-section">
        <img src="{{ asset('images/suplementos.png') }}" alt="Suplementos">
    </div>
</div>
@endsection

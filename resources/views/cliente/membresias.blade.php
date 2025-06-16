
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
        justify-content: center;
        padding: 40px;
    }
    .form-section h2 {
        font-size: 2.2rem;
        font-weight: bold;
        margin-bottom: 40px;
    }
    .cards-container {
        display: flex;
        gap: 20px;
        margin-bottom: 40px;
    }
    .card {
        position: relative;
        cursor: pointer;
    }
    .card input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }
    .card-content {
        width: 160px;
        height: 160px;
        background-color: #1565c0;
        border: 4px solid #001e31;
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
        transition: border-color 0.2s;
    }
    .card input:checked + .card-content {
        border-color: #00c853;
    }
    .card-content div { margin: 4px 0; }
    .submit-btn {
        background-color: #00c853;
        padding: 12px 40px;
        font-size: 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        color: white;
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
        <h2>Membresías</h2>

        <form action="{{ route('cliente.carrito.addMembresia') }}" method="POST">
            @csrf

            <div class="cards-container">
                @foreach($membresias as $m)
                <label class="card">
                    <input type="radio"
                           name="membresia_id"
                           value="{{ $m->idMembresia }}"
                           required>
                    <div class="card-content">
                        <div>{{ $m->nombreMembresia }}</div>
                        <div>{{ $m->duracion }}</div>
                        <div>${{ number_format($m->precioMembresia,0,',','.') }}</div>
                    </div>
                </label>
                @endforeach
            </div>

            <button type="submit" class="submit-btn">Agregar al carrito</button>
        </form>
    </div>

   
</div>
@endsection

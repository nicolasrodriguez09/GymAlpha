@extends('layouts.cliente')

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
        align-items: center;
        padding: 40px;
        overflow-y: auto;
    }
    .form-section h2 {
        font-size: 2.2rem;
        font-weight: bold;
        margin-bottom: 40px;
        text-transform: lowercase;
        text-align: center;
    }
    .cards-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }
    .card {
        background-color: #001e31;
        border: 4px solid #001e31;
        border-radius: 20px;
        width: 160px;
        overflow: hidden;
        text-align: center;
        transition: border-color 0.2s;
    }
    .card:hover {
        border-color: #00c853;
    }
    .card img {
        width: 100%;
        height: auto;
        object-fit: contain;
    }
    .card-content {
        padding: 10px;
    }
    .card-content .name {
        font-weight: bold;
        margin-bottom: 6px;
        text-transform: lowercase;
    }
    .card-content .desc {
        font-size: 0.85rem;
        margin-bottom: 6px;
    }
    .card-content .price {
        margin-bottom: 10px;
        text-transform: lowercase;
    }
    .submit-btn {
        background-color: #00c853;
        padding: 8px 20px;
        font-size: 0.9rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        color: white;
        margin-bottom: 10px;
        text-transform: lowercase;
    }

    /* —— Responsive para tabletas y móviles —— */
    @media (max-width: 1024px) {
        .card {
            width: calc(33.333% - 20px);
        }
    }
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
            height: auto;
        }
        .form-section {
            width: 100%;
            padding: 20px;
        }
        .cards-container {
            gap: 15px;
        }
        .card {
            width: calc(50% - 15px);
        }
    }
    @media (max-width: 480px) {
        .card {
            width: 100%;
        }
    }
</style>

<div class="container">
    <div class="form-section">
        <h2>membresías</h2>

        <div class="cards-container">
            @foreach($membresias as $m)
            <form action="{{ route('cliente.carrito.addMembresia') }}" method="POST" class="card">
                @csrf
                <img src="{{ asset('images/membresias.png') }}" alt="{{ $m->nombreMembresia }}">
                <div class="card-content">
                    <div class="name">{{ $m->nombreMembresia }}</div>
                    <div class="desc">{{ Str::limit($m->descripcionMembresia, 50) }}</div>
                    <div class="price">${{ number_format($m->precioMembresia,2,',','.') }}</div>
                    <input type="hidden" name="membresia_id" value="{{ $m->idMembresia }}">
                    <button type="submit" class="submit-btn">agregar</button>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection

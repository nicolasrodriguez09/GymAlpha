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
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
        width: 100%;
        padding: 0 20px;
    }
    .card {
        background-color: #001e31;
        border: 4px solid #001e31;
        border-radius: 20px;
        overflow: hidden;
        text-align: center;
        transition: border-color 0.2s;
        display: flex;
        flex-direction: column;
    }
    .card:hover {
        border-color: #00c853;
    }
    .card img {
        width: 100%;
        height: 140px;
        object-fit: contain;
    }
    .card-content {
        padding: 10px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .card-content .name {
        font-weight: bold;
        margin-bottom: 10px;
        text-transform: lowercase;
    }
    .card-content .desc {
        font-size: 0.85rem;
        margin-bottom: 10px;
    }
    .card-content .price,
    .card-content .stock {
        margin-bottom: 10px;
        font-size: 0.85rem;
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
        text-transform: lowercase;
    }
    .submit-btn:disabled {
        background-color: #555;
        cursor: not-allowed;
        opacity: 0.6;
    }

    /* —— Responsive Tablets (<=1024px): 2 columnas —— */
    @media (max-width: 1024px) {
        .cards-container {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    /* —— Responsive Móviles (<=768px): 1 columna y apilar contenedor —— */
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
            grid-template-columns: 1fr;
            gap: 15px;
            padding: 0 10px;
        }
    }
</style>

<div class="container">
    <div class="form-section">
        <h2>suplementos</h2>
        @if(session('success'))
            <div style="background-color: #00c853; color: white; padding: 10px 20px; border-radius: 6px; margin-bottom: 20px; text-transform: lowercase; text-align: center;">
                {{ session('success') }}
            </div>
        @endif

        <div class="cards-container">
            @foreach($suplementos as $s)
                <div class="card">
                    @if($s->imagenSuplemento)
                        <img src="{{ Storage::url($s->imagenSuplemento) }}" alt="{{ $s->nombreSuplemento }}">
                    @endif
                    <div class="card-content">
                        <div>
                            <div class="name">{{ $s->nombreSuplemento }}</div>
                            <div class="desc">{{ Str::limit($s->descripcionSuplemento, 50) }}</div>
                            <div class="price">${{ number_format($s->precioSuplemento,2,',','.') }}</div>
                            <div class="stock">Stock: {{ $s->stock ?? '0' }}</div>
                        </div>
                        <form action="{{ route('cliente.carrito.addSuplemento') }}" method="POST">
                            @csrf
                            <input type="hidden" name="suplemento_id" value="{{ $s->idSuplemento }}">
                            <button type="submit" class="submit-btn" @if(($s->stock ?? 0) <= 0) disabled @endif>
                                @if(($s->stock ?? 0) > 0) agregar @else agotado @endif
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

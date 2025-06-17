{{-- resources/views/cliente/spinning.blade.php --}}
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
        overflow-y: auto;
    }
    .form-section h2 {
        font-size: 2.2rem;
        font-weight: bold;
        margin-bottom: 20px;
        text-transform: lowercase;
    }
    .message {
        background-color: #ff5252;
        color: white;
        padding: 12px 20px;
        border-radius: 6px;
        margin-bottom: 20px;
        text-transform: lowercase;
    }
    .message a {
        color: white;
        text-decoration: underline;
    }
    .form-group {
        margin-bottom: 20px;
        width: 100%;
        max-width: 300px;
        text-align: left;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        text-transform: lowercase;
    }
    select {
        width: 100%;
        padding: 10px;
        background-color: #001e31;
        color: white;
        border: none;
        border-radius: 4px;
    }
    .submit-btn {
        background-color: #00c853;
        padding: 12px 30px;
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
        width: 100%;
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    }
</style>

<div class="container">
    <div class="form-section">
        <h2>clases de spinning</h2>

        {{-- Si no tiene membresía activa --}}
        @unless($tieneMembresia)
            <div class="message">
                no puedes reservar clases sin una membresía activa.
                <a href="{{ route('cliente.membresia') }}">contrata aquí</a>
            </div>
        @else
            {{-- Si tiene membresía, mostramos el formulario --}}
            <form action="{{ route('cliente.spinning.reservar') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="clase_id">selecciona una clase</label>
                    <select name="clase_id" id="clase_id" required>
                        <option value="">-- elige una --</option>
                        @foreach($clasesSpinning as $clase)
                            <option value="{{ $clase->idClase }}">
                                {{ $clase->fecha_hora->format('Y-m-d H:i') }} – {{ $clase->instructor }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="submit-btn">reservar</button>
            </form>
        @endunless
    </div>

    <div class="image-section">
        <img src="{{ asset('images/spinning_banner.png') }}" alt="Clase Spinning">
    </div>
</div>
@endsection

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
        justify-content: center;
        padding: 40px;
        overflow-y: auto;
    }
    .form-section h2 {
        font-size: 2.2rem;
        font-weight: bold;
        margin-bottom: 20px;
        text-transform: lowercase;
        text-align: center;
    }
    .message,
    .message-success {
        color: white;
        padding: 12px 20px;
        border-radius: 6px;
        margin-bottom: 20px;
        text-transform: lowercase;
        text-align: center;
        width: 100%;
        max-width: 300px;
    }
    .message { background-color: #ff5252; }
    .message-success { background-color: #00c853; }
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
        transition: background-color 0.2s;
    }
    .submit-btn:hover:not(:disabled) {
        background-color: #00b24a;
    }
    .submit-btn:disabled {
        background-color: #555;
        cursor: not-allowed;
        opacity: 0.6;
    }
    .image-section {
        flex: 1;
        background-color: #013a54;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .image-section img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
            height: auto;
        }
        .form-section,
        .image-section {
            width: 100%;
            padding: 20px;
        }
        .image-section {
            height: 200px;
        }
        .submit-btn {
            width: 100%;
            max-width: 300px;
        }
    }
</style>

<div class="container">
    <div class="form-section">
        <h2>clases de spinning</h2>

        
        @if(session('error'))
            <div class="message">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="message-success">{{ session('success') }}</div>
        @endif

        
        @if($errors->has('clase_id'))
            <div class="message">{{ $errors->first('clase_id') }}</div>
        @endif

        
        @unless($tieneMembresia)
            <div class="message">
                no puedes reservar clases sin una membresía activa.
                <a href="{{ route('cliente.membresias') }}" style="color:#00ff88; text-decoration:underline;">contrata aquí</a>
            </div>
        @else
            {{-- Formulario de reserva --}}
            <form action="{{ route('cliente.spinning.reservar') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="clase_id">selecciona una clase</label>
                    <select name="clase_id" id="clase_id" required>
                        <option value="">-- elige una --</option>
                        @foreach($clasesSpinning as $clase)
                            <option value="{{ $clase->idClaseSpinning }}">
                                {{ $clase->diaClase }} – {{ $clase->horaClase }} (cupos: {{ $clase->cantidadCuposClase }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="submit-btn">reservar</button>
            </form>
        @endunless
    </div>

    <div class="image-section">
        <img src="{{ asset('images/spinning.png') }}" alt="Clase Spinning">
    </div>
</div>
@endsection

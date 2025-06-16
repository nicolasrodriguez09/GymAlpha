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
        justify-content: center;
        padding: 40px;
        overflow-y: auto;
    }
    .form-section h2 {
        font-size: 2.2rem; font-weight: bold; margin-bottom: 40px;
    }
    .form-group { margin-bottom: 20px; text-align: left; }
    .form-group label { display: block; margin-bottom: 5px; }
    .form-group select {
        background-color: #001e31; color: white;
        border: none; padding: 10px; width: 250px; border-radius: 4px;
    }
    .submit-btn {
        background-color: #00c853; padding: 12px 30px;
        font-size: 1rem; border: none; border-radius: 8px;
        cursor: pointer; color: white; margin-top: 20px;
    }
    .class-card {
        background-color: #001e31; border-radius: 8px; padding: 20px; margin-bottom: 20px;
        width: 100%; max-width: 400px;
    }
    .class-card button[disabled] { opacity: 0.5; cursor: not-allowed; }
    .image-section {
        flex: 1; background-color: #002d72;
        display: flex; justify-content: center; align-items: center;
    }
    .image-section img {
        max-height: 90%; object-fit: contain;
        border-radius: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    }
</style>

<div class="container">
    <div class="form-section">
        <h2>Clases de Spinning</h2>

        @unless($tieneMembresia)
            <div style="background:#ffeb3b; padding:10px; border-radius:6px; color:black; margin-bottom:20px;">
                Necesitas una membresía activa para reservar. 
                <a href="{{ route('cliente.membresia') }}" style="text-decoration:underline;">Contrata una aquí</a>.
            </div>
        @endunless

        @if($tieneMembresia)
            @foreach($clasesSpinning as $clase)
                <div class="class-card">
                    <p><strong>Fecha:</strong> {{ $clase->fecha_hora->format('Y-m-d H:i') }}</p>
                    <p><strong>Instructor:</strong> {{ $clase->instructor }}</p>
                    <form action="{{ route('cliente.spinning.reservar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="clase_id" value="{{ $clase->idClase }}">
                        <button 
                          type="submit" 
                          class="submit-btn"
                          @if($clase->estaReservada) disabled @endif
                        >
                            {{ $clase->estaReservada ? 'Reservada' : 'Reservar' }}
                        </button>
                    </form>
                </div>
            @endforeach
        @endif
    </div>

    <div class="image-section">
        <img src="{{ asset('images/spinning.png') }}" alt="Spinning">
    </div>
</div>
@endsection

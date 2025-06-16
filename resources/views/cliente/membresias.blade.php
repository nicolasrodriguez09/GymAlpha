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
        <h2>Elige tu membresía</h2>

        <form action="{{ route('cliente.carrito.addMembresia') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="membresia_id">Membresías disponibles</label>
                <select name="membresia_id" id="membresia_id" required>
                    <option value="">-- Selecciona --</option>
                    @foreach($membresias as $m)
                        <option value="{{ $m->idMembresia }}">
                            {{ $m->nombreMembresia }} — ${{ number_format($m->precioMembresia,2) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="submit-btn">Agregar al carrito</button>
        </form>
    </div>

    <div class="image-section">
        <img src="{{ asset('images/membresia.png') }}" alt="Membresía">
    </div>
</div>
@endsection

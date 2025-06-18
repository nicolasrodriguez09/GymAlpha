@extends('layouts.admin')

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
    }

    .form-section h2 {
        font-size: 2.2rem;
        font-weight: bold;
        margin-bottom: 40px;
    }

    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        background-color: #001e31;
        color: white;
        border: none;
        padding: 10px;
        width: 250px;
        border-radius: 4px;
    }

    .submit-btn {
        background-color: #00c853;
        padding: 12px 30px;
        font-size: 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
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
        height: 100%;
        max-height: 100%;
        max-width: 100%;
        object-fit: cover;
        border-radius: 0px;
        
    }
</style>

<div class="container">
    <!-- Formulario -->
    <div class="form-section">
        <h2>agregar clase de spinning</h2>

        @if(session('success'))
            <div style="background-color: #00c853; color: white; padding: 10px 20px; border-radius: 6px; margin-bottom: 20px;">
                {{session('success')}}

            </div>
        @endif


        <form action="{{ route('spinning.guardar') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="dia">dia clase</label>
                <input type="text" name="dia" required>
            </div>

            <div class="form-group">
                <label for="hora">hora de clase</label>
                <input type="time" name="hora" required>
            </div>

            <div class="form-group">
                <label for="cupos">cantidad de cupos</label>
                <input type="number" name="cupos" required>
            </div>

            <button type="submit" class="submit-btn">guardar</button>
        </form>
    </div>

    <!-- Imagen -->
    <div class="image-section">
        <img src="{{ asset('images/spinningpanel.png') }}" alt="Imagen suplementos">
    </div>
</div>
@endsection

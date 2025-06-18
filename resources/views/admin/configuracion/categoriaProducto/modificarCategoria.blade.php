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
        <h2>Modificar categoria</h2>

        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div style="background-color: #00c853; color: white; padding: 10px 20px; border-radius: 6px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Mensajes de error --}}
        @if($errors->any())
            <div style="background-color: #ff5252; color: white; padding: 10px 20px; border-radius: 6px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 1.2em;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categoria.modificar') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">id categoria</label>
                <input
                    type="number"
                    name="id"
                    id="id"
                    value="{{ old('nombre') }}"
                    required
                >
            </div>
            <div class="form-group">
                <label for="nombre">Nuevo Nombre categoría</label>
                <input
                    type="text"
                    name="nombre"
                    id="nombre"
                    value="{{ old('nombre') }}"
                    required
                >
            </div>
            
            <div class="form-group">
                <label for="descripcion">Nueva Descripción categoría</label>
                <input
                    type="text"
                    name="descripcion"
                    id="descripcion"
                    value="{{ old('descripcion') }}"
                    required
                >
            </div>

            <button type="submit" class="submit-btn">Guardar</button>
        </form>
    </div>

    <!-- Imagen -->
    <div class="image-section">
        <img src="{{ asset('images/configuracion.png') }}" alt="Imagen suplementos">
    </div>
</div>
@endsection

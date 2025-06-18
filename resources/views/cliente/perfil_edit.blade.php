{{-- resources/views/cliente/perfil_edit.blade.php --}}
@extends('layouts.cliente')

@section('content')
<style>
    .container {
        display: flex;
        height: 100vh;
        margin: 0;
        padding: 0;
    }
    .form-section {
        flex: 1;
        background-color: #013a54;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 40px;
        box-sizing: border-box;
        overflow-y: auto;
    }
    .form-section h2 {
        font-size: 2.2rem;
        font-weight: bold;
        margin-bottom: 30px;
        text-transform: lowercase;
        text-align: center;
    }
    .message-success,
    .message-error {
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        margin-bottom: 20px;
        text-transform: lowercase;
        text-align: center;
        width: 100%;
        max-width: 300px;
    }
    .message-success { background-color: #00c853; }
    .message-error   { background-color: #ff5252; }
    .form-group {
        margin-bottom: 20px;
        width: 100%;
        max-width: 400px;
        text-transform: lowercase;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .form-group input {
        width: 100%;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ffffff33;
        background-color: #001e31;
        color: white;
        box-sizing: border-box;
    }
    .btn-save {
        background-color: #00c853;
        padding: 12px 40px;
        font-size: 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        color: white;
        text-transform: lowercase;
        align-self: center;
        margin-top: 20px;
        transition: background-color 0.2s;
    }
    .btn-save:hover {
        background-color: #00b24a;
    }

    .image-section {
        flex: 1;
        background-color: #013a54;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        padding: 0;
        box-sizing: border-box;
    }
    .image-section img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* —— Responsive para tabletas y móviles —— */
    @media (max-width: 1024px) {
        .container {
            height: auto;
        }
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
        .form-group {
            max-width: 100%;
        }
        .btn-save {
            width: 100%;
            max-width: 300px;
        }
    }
    @media (max-width: 480px) {
        .form-section h2 {
            font-size: 1.8rem;
        }
        .form-group input {
            padding: 8px;
        }
        .btn-save {
            padding: 10px 20px;
        }
    }
</style>

<div class="container">
    <div class="form-section">
        <h2>editar perfil</h2>

        @if(session('success'))
            <div class="message-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="message-error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('cliente.perfil.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombreUsu">nombre</label>
                <input type="text"
                       id="nombreUsu"
                       name="nombreUsu"
                       value="{{ old('nombreUsu', $user->nombreUsu) }}"
                       required>
                @error('nombreUsu')
                    <div class="message-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="apellidoUsu">apellido</label>
                <input type="text"
                       id="apellidoUsu"
                       name="apellidoUsu"
                       value="{{ old('apellidoUsu', $user->apellidoUsu) }}">
                @error('apellidoUsu')
                    <div class="message-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="numero_identificacion">número identificación</label>
                <input type="text"
                       id="numero_identificacion"
                       name="numero_identificacion"
                       value="{{ old('numero_identificacion', $user->numero_identificacion) }}">
                @error('numero_identificacion')
                    <div class="message-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="telefonoUsu">teléfono</label>
                <input type="text"
                       id="telefonoUsu"
                       name="telefonoUsu"
                       value="{{ old('telefonoUsu', $user->telefonoUsu) }}">
                @error('telefonoUsu')
                    <div class="message-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-save">guardar cambios</button>
        </form>
    </div>
    <div class="image-section">
        <img src="{{ asset('images/home.png') }}" alt="Imagen perfil">
    </div>
</div>
@endsection

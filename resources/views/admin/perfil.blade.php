@extends('layouts.admin')

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
    }
    .form-section h2 {
        font-size: 2.2rem;
        font-weight: bold;
        margin-bottom: 30px;
        text-transform: lowercase;
        text-align: center;
    }
    .form-section .field {
        display: flex;
        justify-content: space-between;
        margin: 8px 0;
        text-transform: lowercase;
    }
    .form-section .field .label {
        font-weight: bold;
    }
    .submit-btn {
        background-color: #00c853;
        padding: 12px 40px;
        font-size: 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        color: white;
        text-transform: lowercase;
        align-self: center;
        margin-top: 30px;
        text-decoration: none;
    }

    .image-section {
        flex: 1;                         
        background-color: #002d72;
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
</style>

<div class="container">
    <div class="form-section">
        <h2>perfil</h2>

        <div class="field">
            <div class="label">nombre:</div>
            <div>{{ $user->nombreUsu }}</div>
        </div>
        <div class="field">
            <div class="label">apellido:</div>
            <div>{{ $user->apellidoUsu ?? '—' }}</div>
        </div>
        <div class="field">
            <div class="label">número identificación:</div>
            <div>{{ $user->numero_identificacion ?? '—' }}</div>
        </div>
        <div class="field">
            <div class="label">teléfono:</div>
            <div>{{ $user->telefonoUsu ?? '—' }}</div>
        </div>

        <a href="{{ route('admin.perfil.edit') }}" class="submit-btn">
            modificar información
        </a>
    </div>
    <div class="image-section">
        <img src="{{ asset('images/home.png') }}" alt="Imagen perfil">
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div style="display: flex; background-color: #013a54; height: 100vh;">
    <!-- Formulario -->
    <div style="flex: 1; padding: 40px; color: white;">
        <h2 style="text-align: center; font-weight: bold;">agregar membresias</h2>
        <form action="{{ route('membresia.guardar') }}" method="POST">
            @csrf
            <div style="margin-top: 40px;">
                <label>nombre membresia</label>
                <input type="text" name="nombre" required style="display: block; background-color: #001e31; color: white; padding: 10px; margin-bottom: 20px; width: 250px;">
                
                <label>descripcion membresia</label>
                <input type="text" name="descripcion" required style="display: block; background-color: #001e31; color: white; padding: 10px; margin-bottom: 20px; width: 250px;">

                <label>precio membresia</label>
                <input type="number" name="precio" required style="display: block; background-color: #001e31; color: white; padding: 10px; margin-bottom: 20px; width: 250px;">
            </div>

            <button type="submit" style="background-color: #00c853; padding: 10px 20px; border: none; border-radius: 6px;">guardar</button>
        </form>
    </div>

    <!-- Imagen -->
    <div style="flex: 1; background-color: #002d72; display: flex; align-items: center; justify-content: center;">
        <h3 style="color: white; font-weight: bold;">imagen</h3>
    </div>
</div>
@endsection

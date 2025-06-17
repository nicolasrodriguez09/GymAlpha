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
        padding: 40px;
    }

    .form-section h2 {
        font-size: 2.2rem;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 15px;
        width: 100%;
        max-width: 300px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        text-align: center;
    }

    select, input {
        width: 100%;
        padding: 10px;
        background-color: #001e31;
        color: white;
        border: none;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .submit-btn {
        background-color: #00c853;
        padding: 10px 25px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    table {
        margin-top: 30px;
        width: 100%;
        max-width: 500px;
        border-collapse: collapse;
        text-align: center;
    }

    table th, table td {
        padding: 10px;
        border: 1px solid #ffffff33;
    }

    table th {
        background-color: #004080;
        color: white;
    }

    table td {
        background-color: #001e31;
        color: white;
    }
    .table-container {
    max-height: 400px;       
    overflow-y: auto;        
    margin-bottom: 20px;     
    }
    

    .image-section {
        flex: 1;
        background-color: #002d72;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
    }

    .image-section img {
        width: auto;
        max-height: 90%;
        max-width: 100%;
        object-fit: contain;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
    }
</style>

<div class="container">
    <!-- Formulario -->
    <div class="form-section">
        <h2>consultar membresias</h2>

        <form action="{{ route('membresia.consultar') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>consultar por</label>
                <select name="tipo" onchange="toggleBusqueda(this.value)">
                    <option value="todos">todas</option>
                    <option value="id">id</option>
                </select>
            </div>

            <div class="form-group" id="campo-busqueda" style="display: none;">
                <input type="text" name="busqueda" placeholder="Escribe el ID">
            </div>

            <button type="submit" class="submit-btn">buscar</button>
        </form>

        @if($resultados)
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>codigo</th>
                        <th>nombre</th>
                        <th>descripcion</th>
                        <th>precio</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($resultados as $item)
                    <tr>
                        <td>{{ $item->idMembresia }}</td>
                        <td>{{ $item->nombreMembresia }}</td>
                        <td>{{ $item->descripcionMembresia }}</td>
                        <td>{{ number_format($item->precioMembresia, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4">No se encontraron resultados.</td></tr>
                    @endforelse
                </tbody>
            </table>
       
        </div>
        
        @endif
    </div>

    <!-- Imagen -->
    <div class="image-section">
        <img src="{{ asset('images/suplemento.png') }}" alt="Imagen membresías">
    </div>
</div>

<script>
    function toggleBusqueda(value) {
        document.getElementById('campo-busqueda').style.display = (value === 'id') ? 'block' : 'none';
    }
</script>
@endsection

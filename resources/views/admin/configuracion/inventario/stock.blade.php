@extends('layouts.admin')

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
    .form-group select,
    .form-group input {
        background-color: #001e31;
        color: white;
        border: none;
        padding: 10px;
        width: 250px;
        border-radius: 4px;
    }
    table {
        margin-top: 20px;
        width: 100%;
        max-width: 600px;
        border-collapse: collapse;
        text-align: center;
    }
    table th, table td {
        padding: 10px;
        border: 1px solid #ffffff33;
        color: white;
    }
    table th {
        background-color: #004080;
    }
    table td {
        background-color: #001e31;
    }
    .submit-btn {
        background-color: #00c853;
        padding: 12px 30px;
        font-size: 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        color: white;
        margin-top: 20px;
    }
    .image-section {
        flex: 1;
        background-color: #002d72;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .image-section img {
        max-height: 90%;
        object-fit: contain;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    }
</style>

<div class="container">
    <div class="form-section">
        <h2>consultar stock</h2>

        <form method="GET" action="">
            <div class="form-group">
                <label for="tipo">consultar por:</label>
                <select name="tipo" id="tipo" onchange="toggleBusqueda(this.value)">
                    <option value="todos" {{ $tipo=='todos'?'selected':'' }}>todos</option>
                    <option value="id"    {{ $tipo=='id'   ?'selected':'' }}>id</option>
                </select>
            </div>

            <div class="form-group" id="campo-busq" style="display:{{ $tipo=='id'?'block':'none' }}">
                <input type="text" name="q" value="{{ $q }}" placeholder="Ingrese ID">
            </div>

            <button type="submit" class="submit-btn">🔍</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>codigo</th>
                    <th>nombre</th>
                    <th>descripcion</th>
                    <th>cantidad</th>
                    <th>precio</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stocks as $s)
                    <tr>
                        <td>{{ $s->idSuplemento }}</td>
                        <td>{{ $s->nombreSuplemento }}</td>
                        <td>{{ $s->descripcionSuplemento }}</td>
                        <td>{{ $s->stock }}</td>
                        <td>{{ number_format($s->precioSuplemento,2,',','.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5">No hay registros.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="image-section">
        <img src="{{ asset('images/suplemento.png') }}" alt="Imagen membresías" alt="Stock">
    </div>
</div>

<script>
    function toggleBusqueda(v){
        document.getElementById('campo-busq').style.display = v==='id'?'block':'none';
    }
</script>
@endsection

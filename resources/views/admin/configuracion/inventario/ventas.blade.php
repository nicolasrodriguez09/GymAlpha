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
    .form-group select {
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
        max-width: 500px;
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
        <h2>registro de ventas</h2>

        <form method="GET" action="">
            <div class="form-group">
                <label for="suplemento_id">filtro por producto:</label>
                <select name="suplemento_id" id="suplemento_id" onchange="this.form.submit()">
                    <option value="">todos</option>
                    @foreach($suplementos as $s)
                        <option value="{{ $s->idSuplemento }}" {{ request('suplemento_id')==$s->idSuplemento?'selected':'' }}>
                            {{ $s->nombreSuplemento }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <table>
            <thead>
                <tr>
                    <th>codigo</th>
                    <th>nombre</th>
                    <th>cantidad vendida</th>
                    <th>valor</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ventas as $v)
                    <tr>
                        <td>{{ $v->idInventario }}</td>
                        <td>{{ $v->suplemento->nombreSuplemento }}</td>
                        <td>{{ $v->cantSalida }}</td>
                        <td>{{ number_format($v->valor,2,',','.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No se encontraron ventas.</td></tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('admin.configuracion.inventario.ventas') }}" class="submit-btn">consultar ventas</a>
    </div>

    <div class="image-section">
        <img src="{{ asset('images/ventas.png') }}" alt="Ventas">
    </div>
</div>
@endsection

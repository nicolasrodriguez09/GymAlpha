@extends('layouts.admin')

@section('content')
<style>
    .container {
        display: flex;
        height: min-height;
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

    .form-group input,
    .form-group select {
        background-color: #001e31;
        color: white;
        border: none;
        padding: 10px;
        width: 250px;
        border-radius: 4px;
    }

    .form-group input[type="file"] {
        cursor: pointer;
    }

    .submit-btn {
        background-color: #00c853;
        padding: 12px 30px;
        font-size: 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        margin-top: 10px;
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

    .error-text {
        color: #ff5252;
        margin-top: 5px;
    }
</style>

<div class="container">
    <!-- Formulario -->
    <div class="form-section">
        <h2>agregar suplemento</h2>

        @if(session('success'))
            <div style="background-color: #00c853; color: white; padding: 10px 20px; border-radius: 6px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('suplementos.guardar') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="categoria">categoría suplemento</label>
                <select name="categoria" id="categoria" required>
                    <option value="">-- selecciona --</option>
                    @foreach($tiposCategoria as $tipo)
                        <option value="{{ $tipo->idCategoria }}"
                            {{ old('categoria') == $tipo->idCategoria ? 'selected' : '' }}>
                            {{ $tipo->nombreCategoria }}
                        </option>
                    @endforeach
                </select>
                @error('categoria')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="proveedor">seleccionar proveedor</label>
                <select name="proveedor" id="proveedor" required>
                    <option value="">-- selecciona --</option>
                    @foreach($proveedores as $prov)
                        <option value="{{ $prov->idProveedor }}"
                            {{ old('proveedor') == $prov->idProveedor ? 'selected' : '' }}>
                            {{ $prov->nomProveedor }}
                        </option>
                    @endforeach
                </select>
                @error('proveedor')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="marca">marca</label>
                <input type="text" name="marca" id="marca" value="{{ old('marca') }}" required>
                @error('marca')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nombre">nombre suplemento</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="descripcion">descripción suplemento</label>
                <input type="text" name="descripcion" id="descripcion" value="{{ old('descripcion') }}" required>
                @error('descripcion')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="precio">precio suplemento</label>
                <input type="number" name="precio" id="precio" step="0.01" value="{{ old('precio') }}" required>
                @error('precio')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="imagen">agregar imagen</label>
                <input type="file" name="imagen" id="imagen" accept="image/*" onchange="preview(event)" required>
                @error('imagen')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="submit-btn">guardar</button>
        </form>
    </div>

    <!-- Vista previa de la imagen -->
    <div class="image-section">
        <img id="preview" src="{{ asset('images/suplementospanel.png') }}" alt="imagen">
    </div>
</div>

<script>
    function preview(evt) {
        const img = document.getElementById('preview');
        img.src = URL.createObjectURL(evt.target.files[0]);
    }
</script>
@endsection

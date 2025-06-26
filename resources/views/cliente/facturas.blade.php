@extends('layouts.cliente')

@section('content')
<style>
  .wrapper {
    max-width: 800px;
    margin: 40px auto;
    color: white;
    padding: 0 20px;
    box-sizing: border-box;
  }
  .wrapper h2 {
    text-transform: lowercase;
    margin-bottom: 20px;
    text-align: center;
  }
  .invoice {
    background: #013a54;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
  }
  .invoice h3 {
    color: #00c853;
    text-transform: lowercase;
    margin-bottom: 15px;
  }
  .invoice p {
    margin: 6px 0;
    line-height: 1.4;
    text-transform: lowercase;
  }
  .label {
    font-weight: bold;
    text-transform: lowercase;
  }
  .items-wrapper {
    overflow-x: auto;
    margin-top: 15px;
  }
  .items-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 600px;
  }
  .items-table th,
  .items-table td {
    border: 1px solid #ffffff33;
    padding: 8px;
    text-align: left;
    text-transform: lowercase;
  }
  .items-table th {
    background: #004080;
  }
  .items-table td {
    background: #001e31;
  }
  .back-link {
    text-align: center;
    margin-top: 30px;
  }
  .back-link a {
    color: #00c853;
    text-transform: lowercase;
    text-decoration: none;
    transition: color 0.2s;
  }
  .back-link a:hover {
    color: #00b24a;
  }

  /* —— Responsive tablets (≤1024px) —— */
  @media (max-width: 1024px) {
    .invoice {
      padding: 15px;
    }
    .items-table th,
    .items-table td {
      padding: 6px;
    }
  }
  /* —— Responsive móviles (≤768px) —— */
  @media (max-width: 768px) {
    .wrapper {
      margin: 20px auto;
      padding: 0 10px;
    }
    .invoice {
      padding: 15px;
    }
    .invoice h3 {
      font-size: 1.4rem;
    }
    .invoice p {
      font-size: 0.9rem;
    }
    .items-wrapper {
      margin-top: 10px;
    }
    .items-table {
      min-width: 100%;
    }
  }
</style>

<div class="wrapper">
  <h2>tus facturas</h2>

  @if(session('success'))
    <div style="color: #00ff88; margin-bottom: 20px; text-transform: lowercase; text-align: center;">
      {{ session('success') }}
    </div>
  @endif

  @forelse(session('invoices', []) as $inv)
    @if($inv['tipo'] === 'membresia')
      @php $f = $inv['factura']; @endphp
      <div class="invoice">
        <h3>factura membresía #{{ $f->idFacturaMembresia }}</h3>
        <p><span class="label">cliente:</span> {{ $f->usuario->nombreUsu }} {{ $f->usuario->apellidoUsu }}</p>

        <p><span class="label">membresía:</span> {{ $f->membresia->nombreMembresia }}</p>
        <p><span class="label">descripción:</span> {{ $f->membresia->descripcionMembresia }}</p>
        <p><span class="label">precio:</span> ${{ number_format($f->membresia->precioMembresia,2) }}</p>
        <p><span class="label">forma de pago:</span> {{ $f->formaPago->nombreBanco }}
          @if($f->formaPago->numeroCuenta) - {{ $f->formaPago->numeroCuenta }} @endif
        </p>
        <p><span class="label">fecha:</span> {{ \Carbon\Carbon::parse($f->fechaCompra)->format('d/m/Y H:i') }}</p>
      </div>
    @else
      @php
        $f     = $inv['factura'];
        $items = $inv['items'];
      @endphp
      <div class="invoice">
        <h3>factura suplemento #{{ $f->idFacturaSuplemento }}</h3>
        <p><span class="label">cliente:</span> {{ $f->usuario->nombreUsu }} {{ $f->usuario->apellidoUsu }}</p>

        <p><span class="label">fecha:</span> {{ \Carbon\Carbon::parse($f->fechaCompra)->format('d/m/Y H:i') }}</p>
        <p><span class="label">forma de pago:</span> {{ $f->formaPago->nombreBanco }}
          @if($f->formaPago->numeroCuenta) - {{ $f->formaPago->numeroCuenta }} @endif
        </p>

        <div class="items-wrapper">
          <table class="items-table">
            <thead>
              <tr>
                <th>suplemento</th>
                <th>precio</th>
                <th>cantidad</th>
              </tr>
            </thead>
            <tbody>
              @foreach($items as $it)
                <tr>
                  <td>{{ $it['nombre'] }}</td>
                  <td>${{ number_format($it['precio'],2) }}</td>
                  <td>{{ $it['cantidad'] }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @endif
  @empty
    <p style="text-transform: lowercase; text-align: center;">no hay facturas para mostrar.</p>
  @endforelse

  <div class="back-link">
    <a href="{{ route('cliente.carrito') }}">
      ← volver al carrito
    </a>
  </div>
</div>
@endsection

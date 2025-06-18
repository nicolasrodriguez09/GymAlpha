@extends('layouts.cliente')

@section('content')
<style>
  .wrapper { max-width: 800px; margin: 40px auto; color: white; }
  .invoice {
    background: #013a54; padding: 20px; border-radius: 8px;
    margin-bottom: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.3);
  }
  .invoice h3 { color: #00c853; text-transform: lowercase; margin-bottom: 15px; }
  .invoice p { margin: 6px 0; line-height: 1.4; }
  .label { font-weight: bold; text-transform: lowercase; }
  .items-table {
    width: 100%; border-collapse: collapse; margin-top: 15px;
  }
  .items-table th, .items-table td {
    border: 1px solid #ffffff33; padding: 8px; text-align: left;
  }
  .items-table th { background: #004080; text-transform: lowercase; }
  .items-table td { background: #001e31; }
</style>

<div class="wrapper">
  <h2 style="text-transform: lowercase; margin-bottom: 20px;">tus facturas</h2>

  @if(session('success'))
    <div style="color: #00ff88; margin-bottom: 20px;">
      {{ session('success') }}
    </div>
  @endif

  @forelse(session('invoices', []) as $inv)
    @if($inv['tipo'] === 'membresia')
      @php $f = $inv['factura']; @endphp
      <div class="invoice">
        <h3>factura membresía #{{ $f->idFacturaMembresia }}</h3>
        <p><span class="label">cliente:</span> {{ $f->usuario->name }}</p>
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
        <p><span class="label">cliente:</span> {{ $f->usuario->name }}</p>
        <p><span class="label">fecha:</span> {{ \Carbon\Carbon::parse($f->fechaCompra)->format('d/m/Y H:i') }}</p>
        <p><span class="label">forma de pago:</span> {{ $f->formaPago->nombreBanco }}
          @if($f->formaPago->numeroCuenta) - {{ $f->formaPago->numeroCuenta }} @endif
        </p>

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
    @endif
  @empty
    <p>No hay facturas para mostrar.</p>
  @endforelse

  <div style="text-align: center; margin-top: 30px;">
    <a href="{{ route('cliente.carrito') }}"
       style="color: #00c853; text-transform: lowercase; text-decoration: none;">
      ← volver al carrito
    </a>
  </div>
</div>
@endsection

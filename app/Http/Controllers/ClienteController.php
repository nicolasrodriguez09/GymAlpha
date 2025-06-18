<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Membresia;
use App\Models\Suplemento;
use App\Models\Spinning;
use App\Models\Reservar;
use App\Models\FormaPago;
use App\Models\FacturaMembresia;  
use App\Models\FacturaSuplemento; 
use App\Models\Inventario;
use Carbon\Carbon;

class ClienteController extends Controller
{
    
    public function home()
    {
        return view('cliente.home');
    }

    public function membresias()
    {
        $membresias = Membresia::all();
        return view('cliente.membresias', compact('membresias'));
    }


    public function suplementos()
    {
         $suplementos = Suplemento::paginate(9);
         return view('cliente.suplementos', compact('suplementos'));

        
        
    }


    public function spinning()
    {
        $tieneMembresia = \App\Models\FacturaMembresia::where('idUsuario', auth()->id())->exists();
        $clasesSpinning = \App\Models\Spinning::all();

        return view('cliente.spinning', compact('tieneMembresia','clasesSpinning'));
    }

   
    public function verCarrito()
    {
        
        $cart = session('carrito', []);

        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        
        $formas = FormaPago::all();

        
        return view('cliente.carrito', compact('cart', 'total', 'formas'));
    }

   

    
    public function addMembresia(Request $request)
    {
        $request->validate([
            'membresia_id' => 'required|exists:membresia,idMembresia',
        ]);

        $m = Membresia::findOrFail($request->membresia_id);
        $cart = session('carrito', []);

        // Sólo una membresía a la vez
        $cart['membresia'] = [
            'id'        => $m->idMembresia,
            'nombre'   => $m->nombreMembresia,
            'precio'   => $m->precioMembresia,
            'cantidad' => 1,
        ];

        session(['carrito' => $cart]);

        return back()->with('success','Membresía agregada al carrito.');
    }


    public function addSuplemento(Request $request)
    {
        $request->validate([
            'suplemento_id' => 'required|exists:suplemento,idSuplemento',
        ]);

        // 1) Busca el inventario de ese suplemento (asegura que exista stock)
        $inv = Inventario::where('idSuplemento', $request->suplemento_id)
                         ->firstOrFail();

        // 2) Usamos idInventario como clave única en el carrito
        $key = 'supl_'.$inv->idInventario;
        $cart = session('carrito', []);

        if (isset($cart[$key])) {
            // Ya estaba: solo incrementamos cantidad
            $cart[$key]['cantidad']++;
        } else {
            
            $cart[$key] = [
                'nombre' => $inv->suplemento->nombreSuplemento,
                'precio' => $inv->suplemento->precioSuplemento,
                'cantidad' => 1,
                'idInventario' => $inv->idInventario,
            ];
        }

        session(['carrito' => $cart]);
        return back()->with('success','Suplemento agregado al carrito.');
    }

    public function reservarSpinning(Request $request)
    {
        
        $data = $request->validate([
            'clase_id' => 'required|exists:spinning,idClase',
        ]);

        
        $tiene = FacturaMembresia::where('idUsuario', auth()->id())->exists();
        if (! $tiene) {
            return back()->with('error','Debes tener una membresía activa para reservar.');
        }

        
        Reservar::create([
            'idUsuario'  => auth()->id(),
            'idClaseSpinning'    => $data['clase_id'],
            'fechaReserva' => now(),
        ]);

        
        return back()->with('success','Clase de spinning reservada correctamente.');
    }

    
    public function incrementItem(string $key)
    {
        $cart = session('carrito', []);
        if (isset($cart[$key])) {
            $cart[$key]['cantidad']++;
            session(['carrito' => $cart]);
        }
        return back();
    }

    
    public function decrementItem(string $key)
    {
        $cart = session('carrito', []);
        if (isset($cart[$key])) {
            if ($cart[$key]['cantidad'] > 1) {
                $cart[$key]['cantidad']--;
            } else {
                unset($cart[$key]);
            }
            session(['carrito' => $cart]);
        }
        return back();
    }

    public function removeItem(string $key)
    {
        $cart = session('carrito', []);
        if (isset($cart[$key])) {
            unset($cart[$key]);
            session(['carrito' => $cart]);
        }
        return back()->with('success','Producto eliminado del carrito.');
    }

   
    public function clearCart()
    {
        session()->forget('carrito');
        return back()->with('success','Carrito vaciado.');
    }

    public function verFacturas(Request $request)
    {
        // Recupera del flash data el array de facturas
        $invoices = session('invoices', []);
        return view('cliente.facturas', compact('invoices'));
    }

    

   
    public function checkout(Request $request)
    {
        $request->validate([
            'forma_pago' => 'required|exists:forma_pago,idFormaPago',
        ]);

        $cart = session('carrito', []);
        if (empty($cart)) {
            return back()->with('error', 'El carrito está vacío.');
        }

        $invoices = [];

        // 1) Factura de membresía
        if (isset($cart['membresia'])) {
            $m = $cart['membresia'];
            $fm = FacturaMembresia::create([
                'fechaCompra' => Carbon::now(),
                'idUsuario'   => auth()->user()->idUsuario,
                'idMembresia' => $m['id'],
                'idFormaPago' => $request->input('forma_pago'),
            ]);
            $invoices[] = [
                'tipo'    => 'membresia',
                'factura' => $fm,
            ];
        }

        // 2) Factura de suplementos (única para todos los supl_*)
        $suplItems = collect($cart)->filter(fn($item, $key) => str_starts_with($key, 'supl_'));

        if ($suplItems->isNotEmpty()) {
            // Extraemos el idInventario de la clave "supl_{idInventario}"
            $firstKey = $suplItems->keys()->first();            // ej: "supl_42"
            [, $idInventario] = explode('_', $firstKey, 2);
            $idInventario = (int) $idInventario;

            $fs = FacturaSuplemento::create([
                'fechaCompra'  => Carbon::now(),
                'idUsuario'    => auth()->user()->idUsuario,
                'idInventario' => $idInventario,
                'idFormaPago'  => $request->input('forma_pago'),
            ]);

            // Preparamos sólo los campos que realmente necesitas mostrar
            $itemsForView = $suplItems->map(fn($item) => [
                'nombre'   => $item['nombre'],
                'precio'   => $item['precio'],
                'cantidad' => $item['cantidad'],
            ])->values()->all();

            $invoices[] = [
                'tipo'    => 'suplemento',
                'factura' => $fs,
                'items'   => $itemsForView,
            ];
        }

        // 3) Limpia todo el carrito
        session()->forget('carrito');

        // 4) Redirige a la vista unificada de facturas
        return redirect()
            ->route('cliente.facturas')
            ->with([
                'invoices' => $invoices,
                'success'  => 'Compra simulada registrada con éxito.'
            ]);
    }
}

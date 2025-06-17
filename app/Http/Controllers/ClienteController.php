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

        $s = Suplemento::findOrFail($request->suplemento_id);
        $key = 'supl_'.$s->idSuplemento;

        $cart = session('carrito', []);

        if (isset($cart[$key])) {
            $cart[$key]['cantidad']++;
        } else {
            $cart[$key] = [
                'nombre'   => $s->nombreSuplemento,
                'precio'   => $s->precioSuplemento,
                'cantidad' => 1,
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

    public function facturaMembresia($id)
    {
        $factura = FacturaMembresia::with(['usuario','membresia','formaPago'])
                                ->findOrFail($id);
        return view('cliente.factura_membresia', compact('factura'));
    }

    

   
    public function checkout(Request $request)
    {
        
        $request->validate([
            'forma_pago' => 'required|exists:forma_pago,idFormaPago',
        ]);

        $cart = session('carrito', []);
        if (! isset($cart['membresia'])) {
            return back()->with('error','No hay membresía en el carrito.');
        }

        $userId = auth()->user()->idUsuario;
        $factura = FacturaMembresia::create([
            'fechaCompra' => Carbon::now(),
            'idUsuario'   => $userId,
            'idMembresia' => $cart['membresia']['id'],
            'idFormaPago' => $request->input('forma_pago'),
        ]);

        // Limpia el carrito
        session()->forget('carrito');

        // Redirige a la vista de factura individual
        return redirect()
            ->route('cliente.factura.membresia', $factura->idFacturaMembresia)
            ->with('success','Factura creada correctamente.');
    }
}

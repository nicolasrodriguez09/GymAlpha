<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membresia;

class ClienteController extends Controller
{
    public function home(){
        return view('cliente.home');
    }

    public function membresias()
    {
        $membresias = Membresia::paginate(6);
        return view('cliente.membresias', compact('membresias'));
    }

    public function addMembresia(Request $request)
    {
        $membresiaId = $request->input('membresia_id');
        
        return redirect()->route('cliente.carrito');
    }
}

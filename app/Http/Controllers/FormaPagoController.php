<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormaPago;

class FormaPagoController extends Controller
{
    public function guardar (Request $request)
    {
        $request -> validate ([
            'nombreBanco' => 'required|string|max:100',
            'nombreTitular' => 'required|string|max:100',
            'cuenta' => 'required|string|max:50'
        ]);

        FormaPago::create([
            'nombreBanco' => $request->nombreBanco,
            'nombreTitular' => $request->nombreTitular,
            'numeroCuenta' => $request->cuenta
        ]);
        return redirect()->back()->with('success', 'forama de pago creada correctamente');

    }
    
    public function eliminar(Request $request)
    {
        $request -> validate([
            'id' => 'required|numeric'
        ]);

        $formaPago = FormaPago::find($request->id);

        if ($formaPago){
            $formaPago->delete();
            return redirect()->back()->with('success', 'forama de pago eliminada correctamente');
        }else{
            return redirect()->back()->with('error', 'no se encontro ese id de forma de pago');
        }
    }

    public function modificar (Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'nombreBanco' => 'required|string|max:100',
            'nombreTitular' => 'required|string|max:100',
            'cuenta' => 'required|string|max:50'
        ]);

        $formaPago = FormaPago::find($request->id);
        if($formaPago){
            $formaPago->update([
                'nombreBanco' => $request->nombreBanco,
                'nombreTitular' => $request->nombreTitular,
                'numeroCuenta' => $request->cuenta
            ]);
            return redirect()->back()->with('success', 'forama de pago modificada correctamente');
        }else{
            return redirect()->back()->with('error', 'no se encontro ese id de forma de pago');
        }
        
    }

    public function consultar (Request $request)
    {
        $request->validate([
            'tipo' => 'required',
            'busqueda'=> 'nullable|string'
        ]);

        if($request->tipo==='id'&& $request->busqueda)
        {
            $resultados = FormaPago::where('idFormaPago', $request->busqueda)-> get();
        }else{
            $resultados = FormaPago::all();
        }

        return view('admin.configuracion.FormaPago.consultarFormaPago', compact('resultados'));
    }
}

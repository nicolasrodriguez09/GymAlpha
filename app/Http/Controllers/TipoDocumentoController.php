<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoDocumento;

class TipoDocumentoController extends Controller
{
    public function guardar(Request $request){
        $request -> validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:250',
            
        ]);
        $tipoDocumento = TipoDocumento::create([
            'nombreTipoDoc' => $request->nombre,
            'descripcionTipoDoc' => $request->descripcion,
        ]);
        return redirect()->back()->with('success', 'tipo de documento guardado con exito');
    }
}

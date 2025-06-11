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

    public function eliminar(Request $request)
    {
        $request -> validate ([
            'id' => 'required|numeric'
        ]);

        $tipoDocumento = TipoDocumento::find($request->id);

        if($tipoDocumento){
            $tipoDocumento -> delete();

            return redirect()->back()->with('success', 'el tipo de documento se elimino correctamente');
        
        }else{
            return redirect()->back()->with('error', 'no se encontro el id de ese tipo de documento');
        }

    }

    public function modificar (Request $request)
    {
        $request -> validate ([
            'id' => 'required|numeric',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:250'
        ]);

        $tipoDocumento = TipoDocumento::find($request->id);

        if($tipoDocumento){
            $tipoDocumento -> update([
                'nombreTipoDoc' => $request->nombre,
                'descripcionTipoDoc' => $request->descripcion
            ]);

            return redirect()->back()->with('success', 'tipo de documento modificado correctamente');

        }else {
            return redirect()->back()->with('error', 'no se encontro el id de tipo documento');
        }
    }
}

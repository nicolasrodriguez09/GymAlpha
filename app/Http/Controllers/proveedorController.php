<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class proveedorController extends Controller
{
    //
    public function agregar (Request $request)
    {
        $request -> validate([
            'nombre' => 'required|string|max:100',
            'correo'=> 'required|email|',
            'telefono' => 'required|string|max:20',
            'nit' => 'required|string|max:100',

        ]);

        Proveedor::create([
            'nomProveedor' => $request->nombre,
            'emailProveedor'=> $request->correo,
            'telefonoProveedor' => $request->telefono,
            'NITProveedor'=> $request->nit,
        ]);
        return redirect()->back()->with('success', 'proveedor guardado correctamente.');

    }

    public function eliminar (Request $request)
    {
        $request -> validate([
            'id' => 'required|numeric'
        ]);

        $proveedor = Proveedor::find($request->id);
        if($proveedor)
        {
            $proveedor->delete();

            return redirect()->back()->with('success', 'proveedor eliminado correctamente');
        }else{
            return redirect()->back()->with('error', 'no se encontro el id de proveedor');
        }
    }

    public function modificar (Request $request)
    {
        $request -> validate ([
            'id' => 'required|numeric',
            'nombre' => 'required|string|max:100',
            'correo'=> 'required|email|',
            'telefono' => 'required|string|max:20',
            'nit' => 'required|string|max:100',
        ]);
        $proveedor = Proveedor::find($request->id);
        if($proveedor){
            $proveedor -> update([
                'nomProveedor' => $request->nombre,
                'emailProveedor' => $request->correo,
                'telefonoProveedor' => $request->telefono,
                'NITProveedor' => $request->nit,
            ]);
            return redirect()->back()->with('succsess', 'proveedor modificado correctamente');
        }else {
            return redirect()->back()->with('error', 'no se encontro el id del proveedor');
        }

    }

    public function consultar (Request $request)
    {
        $request -> validate ([
            'tipo' => 'required',
            'busqueda' => 'nullable|string'
        ]);
        if ($request->tipo==='id' && $request->busqueda){
            $resultados = Proveedor::where('idProveedor', $request->busqueda)-> get();
        }else{
            $resultados = Proveedor::all();
        }

        return view ('admin.configuracion.proveedor.consultarProveedor', compact('resultados'));
    }
}

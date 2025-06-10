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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membresia;

class MembresiaController extends Controller
{
    public function guardar (Request $request)
    {
        //validacion
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',

        ]);
        //guardar en base de datos
        Membresia::create([
            'nombreMembresia' => $request -> nombre,
            'descripcionMembresia' => $request -> descripcion,
            'precioMembresia' => $request -> precio,
        ]);

        return redirect()->back()->with('success', 'Membresía guardada correctamente.');


    }

    public function eliminar(Request $request)
    {
        $request->validate([
            'id'=> 'required|numeric',
            
        ]);

        $membresia = Membresia::find($request->id);

        if($membresia){
            $membresia->delete();
            return redirect()->back()->with('success', 'membresia eliminada correctamente');
        } else {
            return redirect()->back()->with('success', 'no se encontro la membresia con ese id');
        }
    }
    




























}

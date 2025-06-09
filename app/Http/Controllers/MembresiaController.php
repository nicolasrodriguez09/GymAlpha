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

    public function modificar(Request $request)
    {
        $request->validate([
            'id'=> 'required|numeric',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:250',
            'precio' => 'required|numeric|min:0',
        ]);

        $membresia = Membresia:: find($request->id);

        if($membresia){
            $membresia->update([
                'nombreMembresia' => $request->nombre,
                'descripcionMembresia' => $request->descripcion,
                'precioMembresia' => $request->precio,
            ]);
            return redirect()->back()->with('success', 'Membresía modificada correctamente.');
        } else {
            return redirect()->back()->with('error', 'No se encontró una membresía con ese ID.');
        }

        
    }
    
    public function consultar(Request $request)
    {
        $request->validate([
            'tipo' => 'required',
            'busqueda' => 'nullable|string'
        ]);

        if ($request->tipo === 'id' && $request->busqueda) {
            $resultados = Membresia::where('idMembresia', $request->busqueda)->get();
        } else {
            $resultados = Membresia::all();
        }

        return view('admin.membresia.consultar', compact('resultados'));
    }




























}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spinning;

class spinningController extends Controller
{
    public function guardar (Request $request)
    {
        $request->validate ([
            'dia' => 'required|string|max:10',
            'hora' => 'required|date_format:H:i',
            'cupos' => 'required|int|min:1',
        ]);

        //guardar en base

        Spinning::create ([
            'diaClase' => $request->dia,
            'horaClase' => $request->hora,
            'cantidadCuposClase' => $request -> cupos,
        ]);

        return redirect()->back()->with('success', 'clase guardada correctamente.');
    }

    public function eliminar(Request $request)
    {
        $request -> validate ([
            'id' => 'required|numeric'

        ]);

        $spinning = Spinning :: find($request->id);
        if($spinning){
            $spinning-> delete();

            return redirect()->back()->with('success', 'clase eliminada correctamente');
        } else{
            return redirect()->back()->with('success', 'no se encontro la clase con ese id');
        }

    }

    public function modificar(Request $request){
        $request -> validate ([
            'id' => 'required|numeric',
            'dia' => 'required|string|max:10',
            'hora' => 'required|date_format:H:i',
            'cupos' => 'required|integer|min:1',
        ]);

        $spinning = Spinning::find($request->id);

        if ($spinning){
            $spinning -> update ([
                'diaClase' => $request->dia,
                'horaClase' => $request->hora,
                'cantidadCuposClase' => $request->cupos,

            ]);
            return redirect()->back()->with('success', 'Membresía modificada correctamente.');
        } else {
            return redirect()->back()->with('error', 'No se encontró una membresía con ese ID.');
        }
        
    
    }











}

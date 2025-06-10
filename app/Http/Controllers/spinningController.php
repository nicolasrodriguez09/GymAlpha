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











}
